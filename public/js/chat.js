function loadChat(userId, userName, userImage) {
    incomingUserId = userId;

    const chatInputArea = document.getElementById('chat-input-area');
    const chatPlaceholder = document.getElementById('chat-placeholder');
    const chatMessages = document.getElementById('chat-messages');

    if (chatInputArea) chatInputArea.style.display = 'flex';
    if (chatPlaceholder) chatPlaceholder.style.display = 'none';

    const chatUserImage = document.getElementById('chat-user-image');
    if (chatUserImage) {
        chatUserImage.src = userImage || 'path/to/default-image.png';
        chatUserImage.style.display = 'block';
    }

    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-status').textContent = 'Sedang online';

    chatMessages.innerHTML = '<div class="text-center text-muted">Memuat pesan...</div>';

    fetchMessages(userId);
}

function fetchMessages(userId) {
    const chatMessages = document.getElementById('chat-messages');

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `getchat/${userId}`, true);
    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                chatMessages.innerHTML = ''; // Bersihkan pesan lama

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(chat => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');

                        const sanitizedMessage = document.createElement('div');
                        sanitizedMessage.textContent = chat.message; // Gunakan textContent untuk keamanan

                        const messageContent = document.createElement('div');
                        messageContent.className = `message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded`;
                        messageContent.appendChild(sanitizedMessage);

                        const timeElement = document.createElement('span');
                        timeElement.className = 'message-time ms-2 text-muted';
                        timeElement.textContent = chat.time;

                        messageElement.appendChild(messageContent);
                        messageElement.appendChild(timeElement);

                        chatMessages.appendChild(messageElement);
                    });
                } else {
                    chatMessages.innerHTML = '<div class="text-center text-muted">Tidak ada pesan di chat ini. Mulai percakapan!</div>';
                }

                chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll otomatis
            }
        }
    };
    xhr.send();
}

document.getElementById('sendButton').addEventListener('click', function (event) {
    event.preventDefault();

    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();

    if (messageText && incomingUserId) {
        const chatMessages = document.querySelector('.chat-messages');

        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', 'd-flex', 'justify-content-end', 'mb-3');

        const messageContent = document.createElement('div');
        messageContent.className = 'message-content sent bg-primary text-white p-2 rounded';
        messageContent.textContent = messageText; // Gunakan textContent

        const timeElement = document.createElement('span');
        timeElement.className = 'message-time ms-2 text-muted';
        timeElement.textContent = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        messageElement.appendChild(messageContent);
        messageElement.appendChild(timeElement);

        chatMessages.appendChild(messageElement);
        messageInput.value = ''; // Kosongkan input
        chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll otomatis

        const xhr = new XMLHttpRequest();
        xhr.open("POST", `sendchat/${incomingUserId}`, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'error') {
                        alert(data.message); // Tampilkan error jika ada
                    }
                }
            }
        };
        xhr.send(`id_receiver=${incomingUserId}&message=${encodeURIComponent(messageText)}`);
    }
});

// Perbarui pesan secara otomatis setiap 5 detik tanpa menghapus pesan sebelumnya
function updateChat() {
    if (incomingUserId) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `getchat/${incomingUserId}`, true);
        xhr.onload = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const chatMessages = document.getElementById('chat-messages');
                    const data = JSON.parse(xhr.responseText);

                    if (Array.isArray(data) && data.length > 0) {
                        chatMessages.innerHTML = ''; // Bersihkan pesan lama
                        data.forEach(chat => {
                            const messageElement = document.createElement('div');
                            messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');

                            const sanitizedMessage = document.createElement('div');
                            sanitizedMessage.textContent = chat.message; // Gunakan textContent untuk keamanan

                            const messageContent = document.createElement('div');
                            messageContent.className = `message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded`;
                            messageContent.appendChild(sanitizedMessage);

                            const timeElement = document.createElement('span');
                            timeElement.className = 'message-time ms-2 text-muted';
                            timeElement.textContent = chat.time;

                            messageElement.appendChild(messageContent);
                            messageElement.appendChild(timeElement);

                            chatMessages.appendChild(messageElement);
                        });
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }
            }
        };
        xhr.send();
    }
}

// Interval untuk memperbarui pesan setiap 5 detik
setInterval(updateChat, 5000);
