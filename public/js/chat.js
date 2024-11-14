let incomingUserId = null;  // Menyimpan ID pengguna yang sedang di-chat

// Fungsi untuk memuat chat
function loadChat(userId, userName, userImage) {
    incomingUserId = userId;
    
    const chatInputArea = document.getElementById('chat-input-area');
    const chatPlaceholder = document.getElementById('chat-placeholder');
    const chatMessages = document.getElementById('chat-messages');

    if (chatInputArea) chatInputArea.style.display = 'flex';
    if (chatPlaceholder) chatPlaceholder.style.display = 'none';

    // Menampilkan gambar pengguna dan status
    const chatUserImage = document.getElementById('chat-user-image');
    if (chatUserImage) {
        chatUserImage.src = userImage || 'path/to/default-image.png';
        chatUserImage.style.display = 'block';
    }

    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-status').textContent = 'Sedang online';

    // Memastikan chatMessages tidak dihapus lagi, hanya menambahkan pesan baru
    chatMessages.innerHTML = '<div class="text-center text-muted">Memuat pesan...</div>';

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `get_chat.php?id=${userId}`, true);
    xhr.onload = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                chatMessages.innerHTML = '';  // Clear loading indicator
                const data = JSON.parse(xhr.responseText);

                if (Array.isArray(data) && data.length > 0) {
                    // Menambahkan pesan yang diterima dari server
                    data.forEach(chat => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');
                        
                        // Sanitasi pesan untuk mencegah XSS
                        const sanitizedMessage = document.createElement('div');
                        sanitizedMessage.textContent = chat.message;

                        messageElement.innerHTML = `
                            <div class="message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
                                ${sanitizedMessage.textContent}
                            </div>
                            <span class="message-time ms-2 text-muted">${chat.time}</span>
                        `;
                        chatMessages.appendChild(messageElement);
                    });
                } else {
                    chatMessages.innerHTML = '<div class="text-center text-muted">Tidak ada pesan di chat ini. Mulai percakapan!</div>';
                }
                chatMessages.scrollTop = chatMessages.scrollHeight;  // Scroll ke bawah otomatis
            }
        }
    };
    xhr.send();
}

document.getElementById('sendButton').addEventListener('click', function(event) {
    event.preventDefault(); 

    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();

    if (messageText && incomingUserId) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', 'd-flex', 'justify-content-end', 'mb-3');

        messageElement.innerHTML = `
            <div class="message-content sent bg-primary text-white p-2 rounded">
                ${messageText}
            </div>
            <span class="message-time ms-2 text-muted">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
        `;

        // Menambahkan pesan yang baru tanpa menghapus pesan sebelumnya
        document.querySelector('.chat-messages').appendChild(messageElement);
        messageInput.value = '';  // Clear input

        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;  // Gulir ke bawah otomatis

        // Mengirim pesan ke server menggunakan XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "send_chat.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'error') {
                        alert(data.message);  // Tampilkan pesan error jika ada
                    }
                }
            }
        };
        xhr.send(`id_receiver=${incomingUserId}&message=${encodeURIComponent(messageText)}`);
    }
});

// Fungsi untuk memperbarui pesan secara otomatis setiap beberapa detik
setInterval(() => {
    if (incomingUserId) {
        loadChat(incomingUserId, document.getElementById('chat-user-name').textContent, document.getElementById('chat-user-image').src);
    }
}, 5000);  // 5000 ms atau 5 detik
