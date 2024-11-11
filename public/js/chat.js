// Fungsi untuk memuat percakapan
function loadChat(userId, userName, userImage) {
    // Tampilkan area input pesan dan sembunyikan placeholder hanya setelah nama pengguna diklik
    const chatInputArea = document.getElementById('chat-input-area');
    if (chatInputArea) {
        chatInputArea.style.display = 'flex'; // Tampilkan area input pesan
    } else {
        console.warn('chat-input-area element tidak ditemukan');
    }

    const chatPlaceholder = document.getElementById('chat-placeholder');
    if (chatPlaceholder) {
        chatPlaceholder.style.display = 'none'; // Sembunyikan placeholder
    }

    // Bersihkan pesan sebelumnya
    const chatMessages = document.querySelector('.chat-messages');
    chatMessages.innerHTML = '';

    // Perbarui gambar profil dan detail pengguna di header chat
    const chatUserImage = document.getElementById('chat-user-image');
    chatUserImage.src = userImage || 'path/to/default-image.png'; // Gambar default jika gambar tidak ada
    chatUserImage.style.display = 'block';

    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-status').textContent = 'Sedang online';

    // Muat pesan chat
    fetch(`get_chat.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                chatMessages.innerHTML = '<div class="text-center text-muted">Tidak ada pesan di chat ini. Mulai percakapan!</div>';
            }

            // Tambahkan pesan ke antarmuka
            data.forEach(chat => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');
                
                // Sanitize message content
                const sanitizedMessage = chat.message.replace(/</g, '&lt;').replace(/>/g, '&gt;');
                
                messageElement.innerHTML = `
                    <div class="message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
                        ${sanitizedMessage}
                    </div>
                    <span class="message-time ms-2 text-muted">${chat.time}</span>
                `;
                chatMessages.appendChild(messageElement);
            });

            // Scroll chat window ke bawah
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
            console.error('Error loading chat:', error);
            chatMessages.innerHTML = '<div class="text-center text-muted">Gagal memuat pesan. Coba lagi nanti.</div>';
        });
}

// Fungsi yang memulai tampilan chat saat pengguna dipilih
function showChatButton() {
    const chatInputArea = document.getElementById('chat-input-area');
    if (chatInputArea) {
        chatInputArea.style.display = 'flex'; // Tampilkan tombol pesan
    }
}

// Panggil fungsi `showChatButton` ketika nama pengguna diklik
document.getElementById('user-name').addEventListener('click', () => {
    showChatButton();
});
