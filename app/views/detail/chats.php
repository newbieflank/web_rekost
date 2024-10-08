<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/chats.css">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Re-Kost Logo" height="50">
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#bookings">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <img src="img/user.png" alt="profile">
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="chat-container">
        <div class="chat-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Chats</h2>
                <div class="d-flex align-items-center">
                    <i class="fas fa-plus text-primary ml-2"></i>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <ul class="list-group">
                <li class="list-group-item active">
                    <img src="img/user.png" alt="profil">
                    <div class="chat-info">
                        <h6 style="color: #4a4a4a;">Kos 1</h6>
                        <small style="color: #4a4a4a;">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
                    </div>
                    <div class="chat-details">
                        <div class="chat-time">18:30</div>
                        <div class="chat-badge">1</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="img/user.png" alt="profil">
                    <div class="chat-info">
                        <h6>Kos 2</h6>
                        <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
                    </div>
                    <div class="chat-details">
                        <div class="chat-time">Yesterday</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="img/user.png" alt="profil">
                    <div class="chat-info">
                        <h6>Kos 3</h6>
                        <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
                    </div>
                    <div class="chat-details">
                        <div class="chat-time">18:30</div>
                        <div class="chat-badge">1</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="img/user.png" alt="profil">
                    <div class="chat-info">
                        <h6>Kos 4</h6>
                        <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</small>
                    </div>
                    <div class="chat-details">
                        <div class="chat-time">Yesterday</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <img src="img/user.png" alt="profil">
                <div>
                    <h6>Kos 1</h6>
                    <small>Pemilik Kos</small>
                </div>
                <div class="chat-actions">
                    <i class="fas fa-phone"></i>
                    <i class="fas fa-video"></i>
                    <i class="fas fa-info-circle"></i>
                </div>
            </div>
            <div class="chat-messages">
                <div class="chat-message">
                    <div class="message-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-message">
                    <div class="message-content sent">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                    <div class="message-time">8:00 PM</div>
                </div>
                <div class="chat-input">
                    <i class="fas fa-ellipsis-h"></i>
                    <input type="text" placeholder="Tuliskan Pesan" style="margin-left: 12px;">
                    <i class="fas fa-paper-plane"></i>
                </div>
            </div>
        </div>
    </div>
</body>

</html>