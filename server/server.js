const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');
const mysql = require('mysql');
require('dotenv').config();

const dbConfig = {
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME,
};

// Create and configure the MySQL connection
const db = mysql.createConnection(dbConfig);

// Connect to the database
db.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err);
    } else {
        console.log('Connected to MySQL database');
    }
});

const app = express();
const server = http.createServer(app);

app.use(cors({
    origin: "http://localhost",
    methods: ["GET", "POST"],
}));

const io = new Server(server, {
    cors: {
        origin: "http://localhost",
        methods: ["GET", "POST"],
    },
});

// Listen for client connections
io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    // Store user connections
    socket.on('register', (userId) => {
        socket.userId = userId; // Save the userId to the socket object
        users[userId] = socket.id; // Map the userId to the socket ID
        console.log(`User ${userId} registered with socket ID: ${socket.id}`);
    });


    // Handle chat history loading
    socket.on('load_chat', ({ userId }) => {
        if (!socket.userId) {
            console.error('Socket userId is not set.');
            return;
        }

        console.log(`Fetching chat history for userId: ${userId}, current user: ${socket.userId}`);

        const query = `
        SELECT chat_message.message, 
               chat_message.id_sender, 
               chat_message.id_receiver, 
               DATE_FORMAT(chat_message.waktu_kirim_pesan, '%H:%i') AS time
        FROM chat_message
        WHERE (chat_message.id_sender = ? AND chat_message.id_receiver = ?)
           OR (chat_message.id_sender = ? AND chat_message.id_receiver = ?)
        ORDER BY chat_message.waktu_kirim_pesan ASC
    `;

        db.query(query, [userId, socket.userId, socket.userId, userId], (err, results) => {
            if (err) {
                console.error('Error fetching chat history:', err);
                return;
            }
            console.log('Chat history sent:', results);
            socket.emit('chat_history', { messages: results });
        });
    });


    // Handle sending messages
    socket.on('send_message', (data) => {
        const { id_sender, id_receiver, message } = data;

        // Save the message to the database
        const query = `
            INSERT INTO chat_message (id_sender, id_receiver, message, waktu_kirim_pesan)
            VALUES (?, ?, ?, NOW())
        `;
        db.query(query, [id_sender, id_receiver, message], (err) => {
            if (err) {
                console.error('Error saving message:', err);
                return;
            }
        });

        // Send the message to the receiver in real-time
        const receiverSocketId = users[id_receiver];
        if (receiverSocketId) {
            io.to(receiverSocketId).emit('receive_message', {
                id_sender,
                id_receiver,
                message,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            });
        } else {
            console.log(`User ${id_receiver} is not connected.`);
        }
    });

    // Handle user disconnect
    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
        for (const userId in users) {
            if (users[userId] === socket.id) {
                delete users[userId];
                console.log(`User ${userId} disconnected`);
                break;
            }
        }
    });
});

const users = {}; // Track user socket IDs


// Start the server
server.listen(3000, () => {
    console.log('Server is running on http://localhost:3000');
});
