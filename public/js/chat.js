let incomingUserId = null;
let loadedMessageIds = new Set();
let socket = null;

function connectWebSocket(userId) {
    const wsUrl = `ws://127.0.0.1:8080/ws/chat?id_user=${userId}`;
    console.log(`Connecting WebSocket with URL: ${wsUrl}`);
    socket = new WebSocket(wsUrl);

    socket.onopen = function () {
        console.log('WebSocket connected');
    };

    socket.onmessage = function (event) {
        const data = JSON.parse(event.data); // Mengurai data yang diterima

        if (data.type === 'message') {
            console.log('Received message:', data);
            appendMessage({
                id: data.id,
                message: data.message,
                sent_by_user: data.sent_by_user,
                time: data.time
            });
        }
    };


    socket.onclose = function () {
        console.warn('WebSocket closed. Reconnecting...');
        setTimeout(() => connectWebSocket(userId), 5000); // Attempt to reconnect
    };

    socket.onerror = function (error) {
        console.error('WebSocket error:', error);
    };
}

function appendMessage(chat) {
    const chatMessages = document.getElementById('chat-messages');
    if (!chatMessages) return;

    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : 'justify-content-start', 'mb-3');
    messageElement.id = `chat-message-${chat.id}`;

    messageElement.innerHTML = `
        <div class="message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
            ${chat.message}
        </div>
        <span class="message-time ms-2 text-muted">${chat.time}</span>
    `;

    chatMessages.appendChild(messageElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function loadChat(userId, userName, userImage) {
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
        })
        .catch(error => console.error('Error loading chat:', error));
}   

document.getElementById('sendButton').addEventListener('click', function (event) {
    event.preventDefault();

    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();

    if (messageText && incomingUserId) {
        const id_receiver = document.getElementById('receiverIdInput').value; // Ambil penerima ID dari input

        appendMessage({
            id: `temp-${Date.now()}`,
            message: messageText,
            sent_by_user: true,
            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
        });

        if (socket && socket.readyState === WebSocket.OPEN) {
            socket.send(JSON.stringify({
                type: 'send_message',
                id_sender: incomingUserId,
                id_receiver: id_receiver, // Kirim ke penerima sesuai dengan input
                message: messageText
            }));
        } else {
            console.warn('WebSocket not connected. Fallback to HTTP.');
            const xhr = new XMLHttpRequest();
            xhr.open("POST", `sendchat/${incomingUserId}`, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'error') {
                        alert(data.message);
                    }
                }
            };
            xhr.send(`id_receiver=${id_receiver}&message=${encodeURIComponent(messageText)}`);
        }

        messageInput.value = ''; // Clear the message input field
    }
});  