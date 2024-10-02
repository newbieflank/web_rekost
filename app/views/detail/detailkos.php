<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Re-Kost
    </title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/detailkos.css">
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
    <section class="foto mt-4">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-0 p-4">
                    <a class="text-decoration-none text-dark" href="#">
                        <i class="fas fa-arrow-left">Back</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-7 p-4">
                    <img src="img/home1.png" alt="thumbnail" height="600">
                </div>
                <div class="col-md-5 d-flex flex-wrap justify-content-around p-4">
                    <img src="img/home2.png" alt="thumbnail" width="300" class="mb-2">
                    <img src="img/home3.png" alt="thumbnail" width="300" class="mb-2">
                    <img src="img/home4.png" alt="thumbnail" width="300" class="mb-2">
                    <img src="img/home5.png" alt="thumbnail" width="300" class="mb-2">
                </div>
            </div>
        </div>
        <div class="container-fluid px-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#">Info Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lokasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kebijakan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
            </ul>
        </div>
    </section>
    <script crossorigin="anonymous" integrity="sha384-oBqDVmMz4fnFO9gybBogGz1p6QF1bM4Jp+7F2m1i6U8zTnm5zT9UJ0Zr+2QIT3hK" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
</body>

</html>