<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('css/chats.css') ?>">
    <title>Chat</title>
    <style>
        .chat-input { display: none; }
        .chat-placeholder { display: block; }
        .chat-messages { height: 400px; overflow-y: auto; }
    </style>
</head>
<body>

<section class="chat-container d-flex">
    <!-- Chat Sidebar -->
    <aside class="chat-list p-3 border-end" style="width: 300px;">
        <h2 class="mb-4">Chat</h2>
        <div class="search-bar mb-3 d-flex">
            <input type="text" class="form-control" placeholder="Cari...">
        </div>

        <ul class="list-unstyled">
            <?php if (!empty($onlineUsers)): ?>
                <?php foreach ($onlineUsers as $user): ?>
                    <li class="d-flex align-items-center mb-2">
                        <img src="<?= !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'path/to/your/img/default.png' ?>" 
                             alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2">
                        <span onclick="loadChat(<?= htmlspecialchars($user['id_user']); ?>, '<?= htmlspecialchars($user['nama']); ?>', '<?= htmlspecialchars($user['profile_picture'] ?? 'path/to/your/img/default.png') ?>')" 
                              style="cursor: pointer; color: blue;">
                            <?= htmlspecialchars($user['nama']); ?> sedang online
                        </span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tidak ada pengguna online</li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Chat Window -->
    <section class="chat-window flex-grow-1 p-3">
        <header class="chat-header d-flex align-items-center pb-3 border-bottom mb-3">
        <img src="<?= !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'path/to/your/img/default.png' ?>" 
     alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2">

            <div class="chat-info">
                <div id="chat-user-name"></div>
                <div class="text-muted" id="chat-user-status"></div>
            </div>
        </header>

        <!-- Chat Messages -->
        <section class="chat-messages" id="chat-messages">
            <div class="text-center text-muted chat-placeholder" id="chat-placeholder">Pilih pengguna untuk memulai percakapan.</div>
        </section>

        <!-- Chat Input -->
        <!-- Chat Input -->
<footer class="chat-input align-items-center mt-3" id="chat-input-area">
    <input type="text" class="form-control rounded me-2" placeholder="Tulis Pesan..." id="messageInput">
    <button class="btn btn-primary" id="sendButton">
        <i class="fas fa-paper-plane"></i>
    </button>
</footer>

    </section>
</section>

<script>
    let incomingUserId = null;

    // Load Chat Function
    function loadChat(userId, userName, userImage) {
        incomingUserId = userId;
        
        const chatInputArea = document.getElementById('chat-input-area');
        const chatPlaceholder = document.getElementById('chat-placeholder');
        const chatMessages = document.getElementById('chat-messages');
        
        if (chatInputArea) chatInputArea.style.display = 'flex';
        if (chatPlaceholder) chatPlaceholder.style.display = 'none';
        if (chatMessages) chatMessages.innerHTML = '';

        const chatUserImage = document.getElementById('chat-user-image');
        if (chatUserImage) {
            chatUserImage.src = userImage || 'path/to/default-image.png';
            chatUserImage.style.display = 'block';
        }

        document.getElementById('chat-user-name').textContent = userName;
        document.getElementById('chat-user-status').textContent = 'Sedang online';

        fetch(`get_chat/${userId}`)
            .then(response => response.ok ? response.json() : Promise.reject('Failed to load'))
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(chat => {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');
                        
                        // Sanitasi pesan
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
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => {
                console.log('Error loading chat:', error);
                chatMessages.innerHTML = '<div class="text-center text-muted">Gagal memuat pesan. Coba lagi nanti.</div>';
            });
    }

    // Send Message Function
    document.getElementById('sendButton').addEventListener('click', function() {
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

            document.querySelector('.chat-messages').appendChild(messageElement);
            messageInput.value = '';

            const chatMessages = document.querySelector('.chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Mengirim pesan ke server
            fetch('send_chat/'+incomingUserId, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id_reciver=${incomingUserId}&message=${encodeURIComponent(messageText)}`
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                
                if (data.status === 'error') alert(data.message);   
            })
            .catch(error => console.log('Error sending message:', error));
        }
    });
</script>

</body>
</html>
