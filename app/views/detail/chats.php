<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/chats.css') ?>">
</head>

<body>
    <section class="chat-container">
        <aside class="chat-list">
            <h2 style="margin-bottom: 24px;">Chats</h2>
            <div class="search-bar mb-3 d-flex">
                <input type="text" class="form-control" placeholder="Cari...">
            </div>
            <div class="chat-item active d-flex align-items-center p-2 rounded mb-2">
                <img src="<?= asset('img/user.png') ?>" alt="User profile picture" width="40" height="40" class="rounded-circle me-2">
                <div class="chat-info flex-grow-1">
                    <div>User 1</div>
                    <div class="text-muted">Halo</div>
                </div>
                <div class="chat-time text-muted">18.30</div>
                <div class="chat-unread ms-2 badge bg-primary text-white">1</div>
            </div>
        </aside>
        <section class="chat-window">
            <header class="chat-header d-flex align-items-center pb-3 border-bottom mb-3">
                <img src="<?= asset('img/user.png') ?>" alt="User profile picture" width="40" height="40" class="rounded-circle me-3">
                <div class="chat-info">
                    <div>User 1</div>
                    <div class="text-muted">Pencari Kos</div>
                </div>
            </header>
            <section class="chat-messages">
                <div class="chat-message d-flex mb-3">
                    <div class="message-content bg-light p-2 rounded">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </div>
                    <span class="message-time ms-2 text-muted">8:00 PM</span>
                </div>
                <div class="chat-message d-flex justify-content-end mb-3">
                    <div class="message-content sent bg-primary text-white p-2 rounded">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </div>
                    <span class="message-time ms-2 text-muted">8:00 PM</span>
                </div>
            </section>
            <footer class="chat-input">
                <input type="text" class="form-control rounded me-2" placeholder="Tuliskan Pesan..." id="messageInput">
                <button class="btn btn-primary" id="sendButton">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </footer>
        </section>
    </section>
</body>
<script>
    document.getElementById('sendButton').addEventListener('click', function() {
        // Ambil input pesan
        const messageInput = document.getElementById('messageInput');
        const messageText = messageInput.value.trim();

        // Cek apakah input tidak kosong
        if (messageText) {
            // Buat elemen pesan baru
            const messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', 'd-flex', 'justify-content-end', 'mb-3');

            // Konten pesan
            messageElement.innerHTML = `
                <div class="message-content sent bg-primary text-white p-2 rounded">
                    ${messageText}
                </div>
                <span class="message-time ms-2 text-muted">8:00 PM</span>
            `;

            // Tambahkan pesan ke chat messages
            document.querySelector('.chat-messages').appendChild(messageElement);

            // Bersihkan input
            messageInput.value = '';

            // Scroll ke bawah untuk melihat pesan terbaru
            const chatMessages = document.querySelector('.chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    });
</script>

</html>