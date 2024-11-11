// Fungsi untuk memuat percakapan
function loadChat(userId, userName, userImage) {
    const chatInputArea = document.getElementById('chat-input-area');
    const chatPlaceholder = document.getElementById('chat-placeholder');
    const chatMessages = document.getElementById('chat-messages');
    
    if (chatInputArea) {
        chatInputArea.style.display = 'flex'; // Tampilkan area input pesan
    }

    if (chatPlaceholder) {
        chatPlaceholder.style.display = 'none'; // Sembunyikan placeholder
    }

    // Bersihkan pesan sebelumnya
    if (chatMessages) {
        chatMessages.innerHTML = '';
    }

    // Perbarui gambar profil dan detail pengguna di header chat
    const chatUserImage = document.getElementById('chat-user-image');
    if (chatUserImage) {
        chatUserImage.src = userImage || 'path/to/default-image.png'; // Gambar default jika gambar tidak ada
        chatUserImage.style.display = 'block';
    }

    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-status').textContent = 'Sedang online';

    // Muat pesan chat
    fetch(`get_chat.php?id_user=${userId}`)
        .then(response => {
            // Periksa apakah konten adalah JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Response is not JSON');
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
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
            // Scroll window chat ke bagian bawah
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
            console.error('Error loading chat:', error);
            chatMessages.innerHTML = '<div class="text-center text-muted">Gagal memuat pesan. Coba lagi nanti.</div>';
        });
}
