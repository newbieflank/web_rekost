<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Chat</title>
    <style>
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

    <section class="chat-container d-flex">
        <!-- Chat Sidebar -->
        <aside class="chat-list p-3 border-end" style="width: 300px;">
            <h2 class="mb-4">Chat</h2>
            <div class="search-bar mb-3 d-flex">
                <input type="text" class="form-control" placeholder="Cari..." id="searchBar">
            </div>
            <ul class="list-unstyled" id="userList">
                <?php if (empty($onlineUsers)): ?>
                    <li class="text-center text-muted">Memuat pengguna...</li>
                <?php endif; ?>

                <!-- Start of user loop -->
                <?php foreach ($onlineUsers as $us) : ?>
                    <li class="d-flex align-items-center p-2 mb-2 user-item" style="cursor: pointer;">
                        <img src="<?= !empty($us['profile_picture']) ? htmlspecialchars($us['profile_picture']) : 'path/to/your/img/default.png' ?>"
                            alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2">
                        <span onclick="loadChat(<?= htmlspecialchars($us['id_user']); ?>, '<?= htmlspecialchars($us['nama']); ?>', '<?= htmlspecialchars($us['profile_picture'] ?? 'path/to/your/img/default.png') ?>')"
                            style="cursor: pointer; color: blue;">
                            <?= htmlspecialchars($us['nama']); ?> sedang online
                        </span>
                    </li>
                <?php endforeach; ?>
                <!-- End of user loop -->

            </ul>
        </aside>

        <!-- Chat Window -->
        <section class="chat-window flex-grow-1 p-3">
            <header class="chat-header d-flex align-items-center pb-3 border-bottom mb-3">
                <img src="" alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2" id="chat-user-image">
                <div>
                    <div id="chat-user-name"></div>
                    <div class="text-muted" id="chat-user-status">Tidak diketahui</div>
                </div>
            </header>

            <!-- Chat Messages -->
            <section class="chat-messages" id="chat-messages">
                <div class="text-center text-muted chat-placeholder" id="chat-placeholder">Pilih pengguna untuk memulai percakapan.</div>
            </section>

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
        let socket = null;
        let receiverId = null;
        let chatInterval;
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

            socket.onmessage = function(event) {
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

            // Tangani pesan baru
            if (data.type === 'message' && data.message.id_receiver === incomingUserId) {
                appendMessage(data.message);
            }
        };


        // Perbarui daftar pengguna
        function updateUserList(users) {
            const userList = document.getElementById('userList');
            userList.innerHTML = '';

            if (users.length > 0) {
                users.forEach(user => {
                    const userElement = document.createElement('li');
                    userElement.classList.add('d-flex', 'align-items-center', 'p-2', 'mb-2', 'user-item');
                    userElement.style.cursor = 'pointer';
                    userElement.innerHTML = `
                    <img src="${user.image || 'default-avatar.png'}" alt="Foto profil" class="rounded-circle me-2" width="40" height="40">
                    <div>
                        <div>${user.name}</div>
                        <div class="text-muted small">${user.status === 'online' ? 'Sedang online' : 'Offline'}</div>
                    </div>
                `;
                    userElement.addEventListener('click', () => loadChat(user.id, user.name, user.image));
                    userList.appendChild(userElement);
                });
            } else {
                userList.innerHTML = '<li class="text-center text-muted">Tidak ada pengguna online</li>';
            }
        }

        // Load chat
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

        // Append message
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

        // Send message
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
                    // Kirim pesan melalui WebSocket
                    socket.send(JSON.stringify({
                        type: 'send_message', // Tipe pesan
                        id_receiver: incomingUserId, // ID penerima
                        message: messageText, // Isi pesan
                    }));

                    // Kirim pesan ke server melalui fetch untuk pencatatan (opsional)
                    fetch(`sendchat/${incomingUserId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `id_receiver=${encodeURIComponent(incomingUserId)}&message=${encodeURIComponent(messageText)}`,
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
        // Initialize WebSocket
        connectWebSocket();
    </script>

</body>

</html>