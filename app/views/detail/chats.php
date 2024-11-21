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

</body>
<script src="<?= asset('js/chat.js') ?>"></script>

</html>