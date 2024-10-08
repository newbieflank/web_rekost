<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-Kost</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/strategically.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
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
    <section class="strategically">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between align-items-start" style="margin-top: 24px; margin-bottom: 24px;">
                    <div>
                        <h2 style="font-size: 32px; font-weight: bold; margin-top: 24px">Strategically Located Kosts Near Campus/Office</h2>
                        <p style="font-size: 16px; font-weight: normal; color: #5F5F5F;">Providing you with quick and convenient boarding house recommendations only at Re-kost.</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex overflow-auto">
                    <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Jember</button>
                    <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Bondowoso</button>
                    <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Politeknik Negeri Jember</button>
                    <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Univeristas Muhammadiyah</button>
                    <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Islam</button>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown d-inline-block mr-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-map-marker-alt"></i> Lokasi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownLokasi">
                            <a class="dropdown-item" href="#">Blindungan</a>
                            <a class="dropdown-item" href="#">Tamanan</a>
                            <a class="dropdown-item" href="#">Tamansari</a>
                            <a class="dropdown-item" href="#">Tapen</a>
                            <a class="dropdown-item" href="#">Sempol</a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block mr-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownHarga" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-dollar-sign"></i> Harga
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownHarga">
                            <a class="dropdown-item" href="#">Tertinggi ke Terendah</a>
                            <a class="dropdown-item" href="#">Terendah ke Tertinggi</a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownUrutkan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i> Urutkan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownUrutkan">
                            <a class="dropdown-item" href="#">Popularitas</a>
                            <a class="dropdown-item" href="#">Terbaru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4">
            <div class="row" style="margin-top: 32px;">
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img src="img/home1.png" class="card-img-top" height="200" width="300" />
                        <div class="card-body">
                            <h5 class="card-title">Kos Putri Syariah</h5>
                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                            <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                            <span class="btn-available" style="border-radius: 4px;">Tersedia</span>
                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                IDR 500,000
                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                            </p>
                            <a class="btn-order" href="#">Pesan sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
</body>