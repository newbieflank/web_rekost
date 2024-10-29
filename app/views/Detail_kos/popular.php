<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-kost</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <style>
        body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F3F2FF; /* Mengatur warna latar belakang menjadi putih dengan kode #F3F2FF */
                }

    .navbar {
            background-color: white; /* Warna background untuk navbar */
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

            .header {
            background-color: transparent;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 90px; /* Menambahkan jarak dari navbar */
        }

        .header h1 {
            margin: 0;
        }

        .header .filter {
            display: flex;
            align-items: center;
        }

        .filter button {
            background-color: #F3F2FF; /* Warna background tombol */
            border: 1px solid #ddd;
            padding: 8px 15px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter button:hover {
            background-color: #e0e0ff;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px; /* Jarak antar kartu */
            padding: 20px;
            margin-top: 50px; /* Tambahkan margin untuk mencegah tumpang tindih dengan navbar */
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }

        .card-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }


    </style>
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="img/pemilu.PNG" alt="Re-Kost Logo" height="50" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#home">Home(current) </a>
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
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="login" class="btn btn-outline-primary me-2">Sign In</a>
                </li>
                <li class="nav-item">
                    <a href="register" class="btn btn-primary">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<header class="header">
    <h1>Popular in Re-kost!</h1>
    <div class="filter">
    <button><i class="fa fa-chevron-down"></i> Filter</button>
    <button><i class="fa fa-calendar" aria-hidden="true"></i>Tanggal</button>
    <button><i class="fa fa-dollar-sign"></i>Harga</button>
    <button><i class="fa fa-arrow-up"></i>
    <i class="fa fa-arrow-down"></i>Urutkan</button>
    </div>
</header>

    <div class="container">
        <!-- Kartu 1 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
        <!-- Kartu 2 (dan seterusnya) -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
       <!-- kartu 3 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>

       <!-- kartu 4 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>

       <!-- kartu 5 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>

       <!-- kartu 6 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
       <!-- kartu 7 -->

        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
       <!-- kartu 8  -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
       <!-- kartu 9 -->
        <div class="card">
            <img src="img/rumah.jpeg" alt="Kos Putri Syariah">
            <div class="card-body">
                <h5 class="card-title">Kos Putri Syariah</h5>
                <p class="card-text">4.5/5 (100 Reviews)</p>
                <p class="card-text">Blindungan, Bondowoso</p>
                <p class="card-price">IDR 500,000/month</p>
                <button class="button">Pesan sekarang</button>
            </div>
        </div>
    </div>
<!-- Tambahkan Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
