<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-Kost</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/landingPage.css">
    <script src="js/navbar.js"></script>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
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
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                    <div class="navbar-nav ml-auto mx-4">
                        <img src="<?php echo isset($_SESSION['user_img']) ? $_SESSION['user_img'] : 'img/Vector.svg' ?>" alt="" width="40px">
                    </div>
                <?php else: ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="login" class="btn btn-outline-primary mr-2">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a href="register" class="btn btn-primary">Sign Up</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <section id="home" class="hero-stats">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1 style="margin-bottom: 32px;">Mulai Pencarian Kostmu, Temukan Tempat yang Tepat.</h1>
                    <p style="margin-bottom: 16px; font-size: 14px; color: #4A4A4A; font-weight: 600;">Jelajahi ratusan pilihan kost dengan fitur pencarian yang canggih, mulai dari harga, lokasi, hingga fasilitas yang sesuai dengan kebutuhanmu</p>
                    <button type="button" class="btn btn-lg btn-primary mt-4" style="border-radius: 12px; font-size: 16px; font-weight: bold; padding: 12px 32px;">Booking Now</button>
                </div>
                <div class="col-md-6 position-relative">
                    <div class="image-stack">
                        <img src="img/img1.png" alt="Image 1" class="img-fluid img1">
                        <img src="img/img2.png" alt="Image 2" class="img-fluid img2">
                    </div>
                </div>
            </div>
            <div class="row justify-content-start reviews">
                <div class="col-auto">
                    <h2 style="margin-bottom: 10px; padding-left: 10px; color: #6A0DAD;">0K+</h2>
                    <p style="font-size: 18px; color: #4A4A4A;">Reviews</p>
                </div>
                <div class="col-auto">
                    <h2 style="margin-bottom: 10px; padding-left: 10px; color: #000080;">0K+</h2>
                    <p style="font-size: 18px; color: #4A4A4A;">Booked</p>
                </div>
            </div>

        </div>
    </section>
    <section class="search">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="search-box p-4" style="margin-top: 32px;">
                        <form class="form-row">
                            <div class="form-group col-md-4">
                                <label for="location">Location</label>
                                <div class="input-group position-relative">
                                    <select class="form-control pl-5 pr-5" id="location">
                                        <option value="">Select Location</option>
                                        <option value="blindungan">Blindungan</option>
                                        <option value="tapen">Tapen</option>
                                        <option value="tamnanan">Tamanan</option>
                                        <option value="tamansari">Tamansari</option>
                                        <option value="sempol">Sempol</option>
                                    </select>
                                    <i class="fas fa-map-marker-alt position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%); z-index: 4;"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cost">Cost</label>
                                <div class="input-group position-relative">
                                    <select class="form-control pr-5" id="cost">
                                        <option value="">Select Price Range</option>
                                        <option value="0-100000">Dibawah 100,000</option>
                                        <option value="100000-500000">100,000 - 500,000</option>
                                        <option value="500000-1000000">500,000 - 1,000,000</option>
                                        <option value="1000000-2000000">1,000,000 - 2,000,000</option>
                                        <option value="2000000">Diatas 2,000,000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Date</label>
                                <div class="input-group position-relative">
                                    <input type="date" class="form-control " id="date" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    <section id="bookings" class="popular">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <h2><img src="img/icon.png" alt="Icon" style="margin-right: 16px; margin-top: -4px;">Check what's popular in Re-kost!</h2>
                </div>
            </div>
            <div class="row scroll-container">
                <div class="col-md-3 mb-4">
                    <a href="#" class="card-link">
                        <div class="card">
                            <img src="img/home1.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="#" class="card-link">
                        <div class="card">
                            <img src="img/home2.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="#" class="card-link">
                        <div class="card">
                            <img src="img/home3.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="#" class="card-link">
                        <div class="card">
                            <img src="img/home1.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="#" class="card-link">
                        <div class="card">
                            <img src="img/home3.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="popular">
                        <button type="button" class="btn btn-light btn-wide" style="color: #5D58AF; font-weight: 600;">
                            See all <i class="fas fa-angle-right"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="boarding-house">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <h2>Best Boarding House Options Near You</h2>
                    <p>Providing you with quick and convenient boarding house recommendations only at Re-kost.</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Blindungan</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Tamanan</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Wonosari</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">10+</button>
                </div>
                <a href="best">
                    <div>
                        <button type="button" class="btn btn-custom d-inline-block" style="font-weight: 400;">See all <i class="fas fa-angle-right"></i></button>
                    </div>
                </a>
            </div>
            <div class="row scroll-container">
                <div class="col-md-3 mb-4">
                    <a href="best" class="card-link">
                        <div class="card">
                            <img src="img/home1.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="best" class="card-link">
                        <div class="card">
                            <img src="img/home2.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putra</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Tenggarang, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="best" class="card-link">
                        <div class="card">
                            <img src="img/home3.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Campur Taman Sari</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Taman Sari, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="best" class="card-link">
                        <div class="card">
                            <img src="img/home4.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">KosMU, Tapen</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Tapen, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="best" class="card-link">
                        <div class="card">
                            <img src="img/home2.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Muslimah</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="strategically-located">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Strategically Located Kosts Near Campus/Office</h2>
                        <p>Providing you with quick and convenient boarding house recommendations only at Re-kost.</p>
                    </div>
                    <a href="campus">
                        <button type="button" class="btn btn-custom" style="font-weight: 400;">See all <i class="fas fa-angle-right"></i></button>
                    </a>
                </div>
            </div>
            <div class="row scroll-container">
                <div class="col-md-3 mb-4">
                    <a href="strategically" class="card-link">
                        <div class="card">
                            <img src="img/home1.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putri, Blindungan</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="strategically" class="card-link">
                        <div class="card">
                            <img src="img/home2.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Putra</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Tenggarang, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="strategically" class="card-link">
                        <div class="card">
                            <img src="img/home3.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Campur Taman Sari</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Taman Sari, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="strategically" class="card-link">
                        <div class="card">
                            <img src="img/home4.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">KosMU, Tapen</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Tapen, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="strategically" class="card-link">
                        <div class="card">
                            <img src="img/home2.png" class="card-img-top" alt="Kost Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 20px; font-weight: bold;">Kos Muslimah</h5>
                                <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> Blindungan, Bondowoso</p>
                                <p class="card-text" style="font-weight: 600;">4.5/5 (100 Reviews)</p>
                                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                    IDR 500,000
                                    <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/month</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <section id="service" class="customer-says">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>What our Customer Says About Re-Kost</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-wrapper d-flex">
                        <div class="card mx-3 mb-4" style="width: 300px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="img/user.png" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya. Fitur pencariannya sangat mudah digunakan dan informasi yang disediakan lengkap.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4" style="width: 300px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="img/user.png" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya. Fitur pencariannya sangat mudah digunakan dan informasi yang disediakan lengkap.</p>
                            </div>
                        </div>

                        <div class="card mx-3 mb-4" style="width: 300px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="img/user.png" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya. Fitur pencariannya sangat mudah digunakan dan informasi yang disediakan lengkap.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4" style="width: 300px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="img/user.png" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya. Fitur pencariannya sangat mudah digunakan dan informasi yang disediakan lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr style="border: 1px solid #EEEEEE; margin: 0;">
    <section class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <div class="mt-2">
                        <img src="img/user.png" alt="Circle Image" class="rounded-circle" style="width: 50px; height: 50px;">
                        <div class="star-rating mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <form class="form-inline mt-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control" placeholder="Tuliskan ulasan anda disini...." id="reviewInput">
                            <i class="fas fa-paper-plane send-message position-absolute" style="color: #303030; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 4;" onclick="sendReview()"></i>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <hr style="border: 1px solid #EEEEEE; margin: 0px;">
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h3 style="font-size: 32px; font-weight: bold; margin-bottom: 14px;">Re-Kost</h3>
                    <p style="margin-bottom: 52px;">Enter your email below to be the first to know about new collection and product launches</p>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="example@gmail.com">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 18px; font-weight: semibold;">Service</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 18px; font-weight: semibold;">Social Media</h3>
                    <ul class="list-inline social-buttons">
                        <li><a href="#" class="social-instagram"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" class="social-facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="social-twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="social-whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
</body>

</html>