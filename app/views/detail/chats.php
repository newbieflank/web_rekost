<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="user-id" content="<?= $_SESSION['user']['id_user'] ?>">
    <link rel="stylesheet" href="<?= asset('css/chats.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Chat</title>
    <style>
        .chat-input {
            /* display: none; */
        }

        .chat-placeholder {
            display: block;
        }

        .chat-container {
            height: 100vh;
            padding: 0;
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            gap: 5px;
            background-color: #007bff;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #0554a8;
        }

        .chat-header .btn-secondary {
            font-size: 14px;
            padding: 5px 10px;
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
                    <li class="text-center text-muted">Tidak ada Pengguna</li>
                <?php else: ?>
                    <?php foreach ($onlineUsers as $us): ?>
                        <li class="d-flex align-items-center p-2 mb-2 user-item" style="cursor: pointer;">
                            <a href="?user=<?= $us["id_user"] ?>" class="text-decoration-none">

                                <img src="<?= isset($us['id_gambar']) && $us['id_gambar'] != "" ? asset('uploads/' . $us['id_user'] . '/' . $us['id_gambar']) : asset('img/Vector.svg') ?>" alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2">
                                <span><?= htmlspecialchars($us['nama']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Chat Window -->
        <section class="chat-window flex-grow-1 p-3">
            <header class="chat-header d-flex align-items-center pb-3 border-bottom mb-3">
                <a href="<?= BASEURL ?>" class="btn btn-secondary btn-sm me-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <div class="d-flex align-items-center">
                    <?php if ($user): ?>
                        <img src="<?= isset($user['id_gambar']) && $user['id_gambar'] != "" ? asset('uploads/' . $user['id_user'] . '/' . $user['id_gambar']) : asset('img/Vector.svg') ?>" alt="Foto profil pengguna" width="30" height="30" class="rounded-circle me-2" id="chat-user-image">
                        <div>
                            <div id="chat-user-name"><?= $user['nama'] ?></div>
                            <div class="text-muted" id="chat-user-status"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <!-- Chat Messages -->
            <section class="chat-messages" id="chat-messages">
                <div class="text-center text-muted chat-placeholder" id="chat-placeholder">Pilih pengguna untuk memulai percakapan.</div>
            </section>

            <!-- Chat Input -->
            <footer class="chat-input align-items-center mt-auto" id="chat-input-area">
                <form action="/web_rekost/sendchat/2024115948" id="input-form" method="post" class="d-flex">
                    <input type="text" name="message" class="form-control rounded me-2" placeholder="Tulis Pesan..." id="messageInput">
                    <button type="submit" class="btn btn-primary" id="sendButton">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </form>
            </footer>
        </section>
    </section>

    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= asset('js/chatsHandle.js') ?>"></script>


</body>

</html>