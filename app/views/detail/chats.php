<html>

<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= asset('css/chats.css') ?>">
</head>

<body>
    <div class="chat-container">
        <div class="chat-list">
            <div class="search-bar">
                <input class="form-control" placeholder="Cari..." type="text" />
                <button class="btn btn-primary">
                    <i class="fas fa-plus">
                    </i>
                </button>
            </div>
            <div class="chat-item active">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    18.30
                </div>
                <div class="chat-unread">
                    1
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Yesterday
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Today
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Today
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Today
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Today
                </div>
            </div>
            <div class="chat-item">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        Halo
                    </div>
                </div>
                <div class="chat-time">
                    Today
                </div>
            </div>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <img alt="User profile picture" height="40" src="<?= asset('img/user.png') ?>" width="40" />
                <div class="chat-info">
                    <div>
                        User 1
                    </div>
                    <div class="text-muted">
                        #CU6798H
                    </div>
                </div>
            </div>
            <div class="chat-messages">
                <div class="chat-message">
                    <div class="message-content">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </div>
                    <div class="message-time">
                        8:00 PM
                    </div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </div>
                    <div class="message-time">
                        8:00 PM
                    </div>
                </div>
                <div class="chat-message">
                    <div class="message-content">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </div>
                    <div class="message-time">
                        8:00 PM
                    </div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </div>
                    <div class="message-time">
                        8:00 PM
                    </div>
                </div>
            </div>
            <div class="chat-input">
                <input class="form-control" placeholder="Tuliskan Pesan...." type="text" />
                <button class="btn btn-primary">
                    <i class="fas fa-paper-plane">
                    </i>
                </button>
            </div>
        </div>
    </div>
</body>

</html>