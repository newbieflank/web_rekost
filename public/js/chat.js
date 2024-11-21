let incomingUserId = null;
let socket = null;
let receiverId = null;
let chatInterval = null; // Ensure it's declared here for scope

// Connect WebSocket
function connectWebSocket() {
    const wsUrl = 'ws://127.0.0.1:8080/ws/chat';
    socket = new WebSocket(wsUrl);

    socket.onopen = () => console.log('WebSocket connected');
    socket.onclose = () => {
        console.warn('WebSocket closed. Reconnecting...');
        setTimeout(connectWebSocket, 5000); // Reconnect after 5 seconds
    };
    socket.onerror = (err) => console.error('WebSocket error:', err);

    socket.onmessage = function (event) {
        const data = JSON.parse(event.data); // Parse the incoming data

        // Check the type of message and handle accordingly
        if (data.type === 'message' && data.id_receiver === incomingUserId) {
            console.log('Received message:', data);
            appendMessage({
                id: data.id,
                message: data.message,
                sent_by_user: data.id_sender === incomingUserId,
                time: data.time,
            });
        }
    };
};

// Load chat function
function loadChat(userId, userName, userImage) {
    if (!userId) {
        console.warn('No user selected for chat.');
        return;
    }
    incomingUserId = userId;
    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-status').textContent = 'Sedang online';
    if (document.getElementById('chat-placeholder')) document.getElementById('chat-placeholder').style.display = 'none';
    document.getElementById('chat-input-area').style.display = 'flex';


    fetch(`getchat/${userId}`)
        .then(response => response.json())
        .then(data => {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML = '';

            if (Array.isArray(data.messages)) {
                data.messages.forEach(chat => appendMessage(chat, userId));
            } else {
                chatMessages.innerHTML = '<div class="text-center text-muted">Tidak ada pesan. Mulai percakapan!</div>';
            }

            chatMessages.scrollTop = chatMessages.scrollHeight;

            startChatInterval(userId, userName, userImage);
        })
        .catch(error => console.error('Error loading chat:', error));
}

// Start the interval for refreshing chat
function startChatInterval(userId, userName, userImage) {
    // Clear any existing interval to avoid duplicates
    if (chatInterval) {
        clearInterval(chatInterval);
    }
    // Start a new interval for loading chat
    chatInterval = setInterval(() => {
        console.log('Refreshing chat...');
        loadChat(userId, userName, userImage);
    }, 2000); // Interval every 10 seconds
}

// Stop the interval
function stopChatInterval() {
    if (chatInterval) {
        clearInterval(chatInterval);
        chatInterval = null;
        console.log('Chat interval stopped');
    }
}

// Append message to chat window
function appendMessage(chat, userId) {
    const chatMessages = document.getElementById('chat-messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', 'd-flex', chat.id_sender == userId ? 'justify-content-end' : 'justify-content-start', 'mb-3');
    messageElement.id = `chat-message-${chat.id}`;

    messageElement.innerHTML = `
        <div class="message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
            ${chat.message}
        </div>
        <span class="message-time ms-2 text-muted">${chat.time}</span>`;

    chatMessages.appendChild(messageElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Send message when user clicks the send button
document.getElementById('sendButton').addEventListener('click', () => {
    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();
    if (messageText) {
        const tempMessage = {
            message: messageText,
            sent_by_user: true,
            time: new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            }),
        };
        appendMessage(tempMessage);
        messageInput.value = '';

        if (socket && socket.readyState === WebSocket.OPEN) {
            // Send message through WebSocket
            socket.send(JSON.stringify({
                type: 'send_message', // Message type
                id_receiver: incomingUserId, // Receiver ID
                message: messageText, // Message content
            }));

            // Send message to server via fetch for logging (optional)
            fetch(`sendchat/${incomingUserId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_receiver=${encodeURIComponent(incomingUserId)}&message=${encodeURIComponent(messageText)}`
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Pesan terkirim ke server:', data);
                })
                .catch(error => {
                    console.error('Error sending message via fetch:', error);
                });
        } else {
            console.error('WebSocket connection is not open.');
        }
    }
})

// Initialize WebSocket connection after page load
document.addEventListener('DOMContentLoaded', () => {
    connectWebSocket();
});
