<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/chats.css') ?>">
    <title>Chat</title>
    <style>
        /* Sembunyikan input pesan di awal */
        .chat-input {
            display: none;
        }
        .chat-placeholder {
            display: block;
        }
        .chat-messages {
            height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<script src="js/chat.js"></script>

<section class="chat-container d-flex">
    <!-- Sidebar Chat List -->
    <aside class="chat-list p-3 border-end" style="width: 300px;">
        <h2 style="margin-bottom: 24px;">Chats</h2>
        <div class="search-bar mb-3 d-flex">
            <input type="text" class="form-control" placeholder="Cari...">
        </div>

        <ul class="list-unstyled">
            <?php if (!empty($onlineUsers)): ?>
                <?php foreach ($onlineUsers as $user): ?>
                    <!-- User item with clickable name -->
                    <li class="d-flex align-items-center mb-2">
                        <img src="<?= !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'path/to/your/img/default.png' ?>" 
                             alt="User profile picture" width="30" height="30" class="rounded-circle me-2">
                        <span onclick="loadChat(<?= htmlspecialchars($user['id_user']); ?>, '<?= htmlspecialchars($user['nama']); ?>', '<?= htmlspecialchars($user['profile_picture'] ?? 'path/to/your/img/default.png') ?>')" 
                              data-id="<?= htmlspecialchars($user['id_user']); ?>" style="cursor: pointer; color: blue;">
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
            <img src="<?= asset('img/user.png') ?>" alt="User profile picture" width="40" height="40" class="rounded-circle me-3" id="chat-user-image" style="display: none;">
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
        <footer class="chat-input align-items-center mt-3">
            <input type="text" class="form-control rounded me-2" placeholder="Tuliskan Pesan..." id="messageInput">
            <button class="btn btn-primary" id="sendButton">
                <i class="fas fa-paper-plane"></i>
            </button>
        </footer>
    </section>
</section>

<script>
    let incomingUserId = null; // Store the selected user's ID

    // Function to load chat based on user ID and user profile picture
    function loadChat(userId, userName, userImage) {
        incomingUserId = userId; // Store the selected user's ID
        
        // Tampilkan input pesan dan sembunyikan placeholder
        document.querySelector('.chat-input').style.display = 'flex';
        
        const chatPlaceholder = document.getElementById('chat-placeholder');
        if (chatPlaceholder) {
            chatPlaceholder.style.display = 'none'; // Sembunyikan placeholder
        }

        // Kosongkan pesan sebelumnya
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.innerHTML = ''; 

        // Update profile image and user details in the chat header
        const chatUserImage = document.getElementById('chat-user-image');
        chatUserImage.src = userImage;
        chatUserImage.style.display = 'block';

        document.getElementById('chat-user-name').textContent = userName;
        document.getElementById('chat-user-status').textContent = 'Sedang online';

        // Memuat pesan chat
        fetch(`get_chat.php?id_user=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    chatMessages.innerHTML = '<div class="text-center text-muted">Tidak ada pesan di chat ini.</div>';
                }

                data.forEach(chat => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('chat-message', 'd-flex', chat.sent_by_user ? 'justify-content-end' : '', 'mb-3');
                    
                    messageElement.innerHTML = ` 
                        <div class="message-content ${chat.sent_by_user ? 'sent bg-primary text-white' : 'bg-light'} p-2 rounded">
                            ${chat.message}
                        </div>
                        <span class="message-time ms-2 text-muted">${chat.time}</span>
                    `;
                    chatMessages.appendChild(messageElement);
                });

                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => console.error('Error loading chat:', error));
    }

    // Send message to the backend
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

            // Send the message via AJAX to the backend
            fetch('send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `incoming_id=${incomingUserId}&message=${encodeURIComponent(messageText)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    alert(data.message); // Show error if message sending fails
                }
            })
            .catch(error => console.error('Error sending message:', error));
        }
    });
</script>

</body>
</html>
