// let incomingUserId = null;
// let socket = null;
// let userId = document.querySelector('meta[name="user-id"]').content;

// // Connect to Socket.IO
// function connectSocketIO() {
//     if (socket) {
//         console.warn('Socket.IO already connected.');
//         return;
//     }

//     socket = io('http://127.0.0.1:3000');

//     socket.on('connect', () => {
//         console.log('Socket.IO connected with ID: ' + socket.id);
//         socket.emit('register', userId);
//     });

//     socket.on('disconnect', () => {
//         console.warn('Socket.IO disconnected. Reconnecting...');
//         setTimeout(connectSocketIO, 5000);
//     });

//     socket.on('error', (err) => {
//         console.error('Socket.IO error:', err);
//     });
//     6
//     const unreadMessages = {};

//     socket.on('receive_message', (data) => {
//         if (data.id_sender == incomingUserId) {
//             appendMessage(data, userId);
//         } else {
//             unreadMessages[data.id_sender] = (unreadMessages[data.id_sender] || 0) + 1;
//             console.log(`User ${data.id_sender} has ${unreadMessages[data.id_sender]} unread messages.`);
//             // Update UI to show unread count
//         }
//     });

//     socket.on('chat_history', ({ messages }) => {
//         const chatMessages = document.getElementById('chat-messages');
//         chatMessages.innerHTML = '';
//         if (messages && messages.length > 0) {
//             messages.forEach(chat => appendMessage(chat, userId));
//         } else {
//             chatMessages.innerHTML = '<div class="text-center text-muted">No messages yet. Start the conversation!</div>';
//         }
//     });
// }

// // Load chat for a selected user
// function loadChat(userId, userName, userImage) {
//     if (!userId) {
//         console.warn('No user selected for chat.');
//         return;
//     }
//     incomingUserId = userId;
//     document.getElementById('chat-user-name').textContent = userName;
//     document.getElementById('chat-user-status').textContent = '';
//     document.getElementById('chat-user-image').src = userImage;
//     document.getElementById('chat-user-image').style.display = 'block';
//     document.getElementById('chat-input-area').style.display = 'flex';
//     if (socket && socket.connected) {
//         socket.emit('load_chat', { userId });
//     } else {
//         console.error('Socket.IO connection is not open. Retrying...');
//         setTimeout(() => loadChat(userId, userName, userImage), 1000);
//     }
// }

// // Append message to chat window
// function appendMessage(chat, userId) {
//     const chatMessages = document.getElementById('chat-messages');
//     const messageElement = document.createElement('div');
//     messageElement.classList.add(
//         'chat-message',
//         'd-flex',
//         chat.id_sender == userId ? 'justify-content-end' : 'justify-content-start',
//         'mb-3'
//     );

//     messageElement.innerHTML = `
//         <div class="message-content ${chat.id_sender == userId ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
//             ${chat.message}
//         </div>
//         <span class="message-time ms-2 text-muted">${chat.time}</span>
//     `;
//     chatMessages.appendChild(messageElement);
//     chatMessages.scrollTop = chatMessages.scrollHeight;
// }

// // Send message
// // Add event listener for the "Enter" key
// document.getElementById('messageInput').addEventListener('keydown', (event) => {
//     if (event.key === 'Enter' && !event.shiftKey) {
//         event.preventDefault(); // Prevent the default newline behavior
//         sendMessage();
//     }
// });

// // Existing "Send" button click handler
// document.getElementById('sendButton').addEventListener('click', sendMessage);

// // Function to send a message
// function sendMessage() {
//     const messageInput = document.getElementById('messageInput');
//     const messageText = messageInput.value.trim();
//     if (messageText) {
//         const tempMessage = {
//             message: messageText,
//             id_sender: userId,
//             time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
//         };
//         appendMessage(tempMessage, userId);
//         messageInput.value = '';

//         if (socket && socket.connected) {
//             socket.emit('send_message', {
//                 id_sender: userId,
//                 id_receiver: incomingUserId,
//                 message: messageText,
//             });
//         } else {
//             console.error('Socket.IO connection is not open.');
//         }
//     }
// }

// function Image(id, gambar) {
//     const uri = 'http://localhost/web_rekost/public/';

//     if (gambar) {
//         img = uri + 'uploads/' + id + '/' + gambar
//     } else {
//         img = uri + 'img/Vector.svg'
//     }

//     return img
// }

// // Initialize Socket.IO connection
// document.addEventListener('DOMContentLoaded', () => {
//     const urlParams = new URLSearchParams(window.location.search);
//     const userId = urlParams.get('id');
//     const userNama = urlParams.get('nama');
//     const userImage = urlParams.get('gambar');
//     let ImageUri = Image(userId, userImage);

//     if (userId) {
//         loadChat(userId, userNama, ImageUri);
//     } else {
//         console.warn('No ID found in URL.');
//     }
//     connectSocketIO();
// });

//NEW CHAT CODE
const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get("user");
let intervalId = null;
let lastChatId = null;

const formatChatDateTime = (datetime) => {
  const date = new Date(datetime);
  return date.toLocaleTimeString("id-ID", {
    hour: "2-digit",
    minute: "2-digit",
  });
};

const scrollToBottom = (selector) => {
  const element = $(selector);
  element.scrollTop(element.prop("scrollHeight"));
};

const showChat = (user_id) => {
  $.get(`/web_rekost/getchat/${user_id}`).done((data) => {
    const messages = JSON.parse(data).messages;

    if (
      messages.length > 0 &&
      messages[messages.length - 1].time !== lastChatId
    ) {
      $("#chat-messages").empty();
      messages.forEach((message) => generateChat(message, user_id));
      lastChatId = messages[messages.length - 1].time; // Perbarui ID pesan terakhir
      scrollToBottom("#chat-messages");
    }
  });
};

const generateChat = (chat, userId) => {
  const alignment =
    chat.id_sender == userId ? "justify-content-start" : "justify-content-end";
  const messageClass =
    chat.id_sender == userId ? "bg-light " : "sent   bg-primary text-white";

  const messageElement = `
    <div class="chat-message d-flex ${alignment} mb-3">
      <div class="message-content d-flex align-items-end ${messageClass} p-2 rounded">
        <p class="m-0">${chat.message}</p>
        <small class="ms-2" style="margin-top: 5px">${formatChatDateTime(
          chat.time
        )}</small>
      </div>
    </div>
  `;
  $("#chat-messages").append(messageElement);
};

const sendMessage = (e) => {
  e.preventDefault();
  const message = e.target.message.value.trim();
  if (!message) return;

  $.post(`/web_rekost/sendchat/${userId}`, { message }).done(() => {
    e.target.reset();
    showChat(userId);
  });
};

const init = () => {
  clearInterval(intervalId);
  $(".chat-input").show();
  showChat(userId);

  intervalId = setInterval(() => {
    showChat(userId);
  }, 500);
};

// Event listeners
$("#input-form").on("submit", sendMessage);

// Initialize chat
if (userId) {
  init();
}
