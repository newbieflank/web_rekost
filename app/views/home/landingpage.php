<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/landingPage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #F3F2FF;">
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.svg" alt="Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-2 mb-lg-0" style="font-size: 1rem;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex" role="search" style="width: 200px;">
                    <button class="btn btn-outline-secondary navbar-btn me-2" type="button">Sign In</button>
                    <button class="btn btn-primary navbar-btn" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>
    <main class="pb-5">
        <div class="content-wrapper">
            <div class="text-content">
                <h2 class="mt-2" style="font-weight: semibold; font-size: 48px;  margin-bottom: 32px;">Mulai Pencarian Kostmu, Temukan Tempat yang Tepat.</h2>
                <p class="mt-3" style="margin-bottom: 32px;">Jelajahi ratusan pilihan kost dengan fitur pencarian yang canggih, mulai dari harga, lokasi, hingga fasilitas yang sesuai dengan kebutuhanmu.</p>
                <button class="main-btn mt-3" style="margin-top: 0;">Booking Now</button>
                <div class="stats mt-4">
                    <div class="stat">
                        <p style="color: #6A0DAD; font-weight: bold;">100K+</p>
                        <p>Reviews</p>
                    </div>
                    <div class="stat">
                        <p style="color: #000080; font-weight: bold;">100K+</p>
                        <p>Booked</p>
                    </div>
                </div>
            </div>
            <div class="image-container mt-3">
                <img src="img/img2.png" alt="Image 2">
                <img class="second" src="img/img1.png" alt="Image 1">
            </div>
        </div>
    </main>
    <div style="background-color: #5d58af; padding: 50px 0; position: relative; z-index: 1;">
        <div class="container">
            <h2 class="text-left" style="font-weight: semibold; padding-bottom: 32px; color: white;">Check what’s popular in Re-kost!</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/card1.jpg" class="card-img-top" alt="Card 1">
                        <div class="card-body">
                            <h5 class="card-title">Kost 1</h5>
                            <p class="card-text">Deskripsi singkat mengenai Kost 1.</p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/card2.jpg" class="card-img-top" alt="Card 2">
                        <div class="card-body">
                            <h5 class="card-title">Kost 2</h5>
                            <p class="card-text">Deskripsi singkat mengenai Kost 2.</p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/card3.jpg" class="card-img-top" alt="Card 3">
                        <div class="card-body">
                            <h5 class="card-title">Kost 3</h5>
                            <p class="card-text">Deskripsi singkat mengenai Kost 3.</p>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a href="#" class="btn btn-outline-light btn-lg d-flex align-items-center">
                    See All
                    <i class="ms-2 bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>