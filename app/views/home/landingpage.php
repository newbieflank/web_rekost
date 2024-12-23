<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-Kost</title>
    <link rel="stylesheet" href="<?= asset('css/landingPage.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/popular.css') ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 50px;
        }

        .card {
            width: 100%;
            height: auto;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .star-rating .fa-star {
            cursor: pointer;
            font-size: 24px;
            transition: color 0.2s ease;
        }

        .star-rating .fa-star.inactive {
            color: #ccc;
        }

        .star-rating .fa-star.active {
            color: #f39c12;
        }

        #cityContainer {
            max-width: 700px;
            display: flex;
            gap: 10px;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
        }

        #cityContainer::-webkit-scrollbar {
            height: 8px;
        }

        #cityContainer::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <a class="navbar-brand" href="#">
                <img src="<?= asset('img/logo.png') ?>" alt="Re-Kost Logo" height="50">
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
                <?php

                use Google\Service\Analytics\Uploads;

                if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                    <div class="navbar-nav ml-auto mx-4 d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="notifDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
                                <!-- <?php
                                        var_dump($data['notifikasi']);
                                        ?> -->
                                <?php if (empty($data['notifikasi'])): ?>
                                    <div class="dropdown-item text-center">Tidak ada notifikasi terbaru</div>
                                <?php else: ?>
                                    <?php foreach ($data['notifikasi'] as $notif): ?>
                                        <div class="dropdown-item">
                                            <?php if (isset($notif['sisa_hari']) && $notif['sisa_hari'] <= 3 && $notif['sisa_hari'] >= 0): ?>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-exclamation-circle text-warning mr-2"></i>
                                                    <div>
                                                        <small class="text-muted">Masa sewa akan berakhir</small>
                                                        <p class="mb-0">
                                                            <?= $notif['sisa_hari'] == 0 ? 'Hari ini' : "dalam {$notif['sisa_hari']} hari" ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="dropdown-item">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success mr-2"></i>
                                                <div>
                                                    <small class="text-muted">
                                                    <?php
                                                        if (isset($notif['tanggal_penyewaan'])) {
                                                            $date1 = new DateTime($notif['tanggal_penyewaan']);
                                                            $date2 = new DateTime();
                                                            $interval = $date1->diff($date2);

                                                            if ($interval->days == 0) {
                                                                echo "Pembayaran hari ini";
                                                            } else {
                                                                $formattedDate = $date1->format('d/m/Y');
                                                                echo "Pembayaran pada tanggal: {$formattedDate}";
                                                            }
                                                        }
                                                        ?>
                                                    </small>
                                                    <p class="mb-0">
                                                        Pembayaran kost sebesar Rp
                                                        <?= number_format($notif['harga'], 0, ',', '.') ?> telah
                                                        dikonfirmasi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                    <?php endforeach; ?>
                                    <a class="dropdown-item text-center" href="<?= BASEURL; ?>riwayat">Lihat semua riwayat
                                        pembayaran</a>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/user.png') ?>"
                                    class="rounded-circle" alt="Profile Image" width="40px" height="40px">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="<?= BASEURL; ?>profile">Profile</a>
                                <a class="dropdown-item" href="<?= BASEURL; ?>riwayat">Riwayat</a>
                                <?php if ($_SESSION['user']['role'] === 'pemilik kos'): ?>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>datakos">Profile Kost</a>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>datakamar">Tambah Kamar</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout">Logout</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>login" class="btn btn-outline-primary mr-2">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>register" class="btn btn-primary">Sign Up</a>
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
                    <p style="margin-bottom: 16px; font-size: 14px; color: #4A4A4A; font-weight: 600;">Jelajahi ratusan
                        pilihan kost dengan fitur pencarian yang canggih, mulai dari harga, lokasi, hingga fasilitas
                        yang sesuai dengan kebutuhanmu</p>
                    <button onclick="window.location.href='#bookings'" type="button" class="btn btn-lg btn-primary mt-4"
                        style="border-radius: 12px; font-size: 16px; font-weight: bold; padding: 12px 32px;">Pesan
                        Sekarang</button>
                </div>
                <div class="col-md-6 position-relative">
                    <div class="image-stack">
                        <img src="<?= asset('img/img1.png') ?>" alt="Image 1" class="img-fluid img1">
                        <img src="<?= asset('img/img2.png') ?>" alt="Image 2" class="img-fluid img2">
                    </div>
                </div>
            </div>
            <div class="row justify-content-start reviews">
                <?php
                // Menampilkan total rating
                if (!empty($data['rating_aplikasi'])):
                    $rating = current($data['rating_aplikasi']); // Ambil elemen pertama
                ?>
                    <div class="col-auto">
                        <h2 style="margin-bottom: 10px; padding-left: 10px; color: #6A0DAD;">
                            <?php echo htmlspecialchars($rating['total_rating']) ? $rating['total_rating'] : 0; ?>
                        </h2>
                        <p style="font-size: 18px; color: #4A4A4A;">Ulasan</p>
                    </div>
                <?php
                endif;

                // Menampilkan jumlah penyewa
                if (!empty($data['penyewa'])):
                    $penyewa = current($data['penyewa']); // Ambil elemen pertama
                ?>
                    <div class="col-auto">
                        <h2 style="margin-bottom: 10px; padding-left: 10px; color: #000080;">
                            <?php echo htmlspecialchars($penyewa['jumlah_penyewa']) ? $penyewa['jumlah_penyewa'] : 0; ?>
                        </h2>
                        <p style="font-size: 18px; color: #4A4A4A;">Pesanan</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <section class="search">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="search-box p-4" style="margin-top: 32px;">
                        <form id="searchForm" method="post" action="<?= BASEURL; ?>search" class="form-row">
                            <div class="form-group col-md-6">
                                <label for="location">Lokasi</label>
                                <div class="input-group position-relative">
                                    <select class="form-control pl-5 pr-5" id="location" name="location" required>
                                        <option value="">Pilih Lokasi</option>
                                        <option value="Jember">Jember</option>
                                        <option value="Bondowoso">Bondowoso</option>
                                    </select>
                                    <i class="fas fa-map-marker-alt position-absolute"
                                        style="left: 10px; top: 50%; transform: translateY(-50%); z-index: 4;"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cost">Harga</label>
                                <div class="input-group position-relative">
                                    <select class="form-control pr-5" id="cost" name="cost">
                                        <option value="">Pilih Harga</option>
                                        <option value="0-100000">Dibawah 100,000</option>
                                        <option value="100000-500000">100,000 - 500,000</option>
                                        <option value="500000-1000000">500,000 - 1,000,000</option>
                                        <option value="1000000-2000000">1,000,000 - 2,000,000</option>
                                        <option value="2000000-1000000000">Diatas 2,000,000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="bookings" class="popular">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <h2><img src="<?= asset('img/icon.png') ?>" alt="Icon"
                            style="margin-right: 16px; margin-top: -4px;">Temukan Kost Terpopuler di Re-Kost!</h2>
                </div>
            </div>
            <div class="row scroll-container">
                <?php foreach ($data['popular'] as $popular): ?>
                    <div class="col-md-4 mb-5">
                        <a href="<?= BASEURL . 'detailkos/' . $popular["id_kos"] ?>" class="card-link">
                            <div class="card">
                                <?php
                                $path = $popular["id_kos"] . '/foto_depan.jpg';
                                $absolutePath = Uploads($path);
                                if (file_exists($absolutePath)) {
                                ?>
                                    <img src="<?= asset('uploads/' . $path) ?>" class="card-img-top" alt="Kost Image">
                                <?php
                                } else {

                                ?>
                                    <img src="<?= asset(path: 'default/default.jpg') ?>" class="card-img-top"
                                        alt="No Image Available">
                                <?php
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">
                                        <?php echo $popular['nama_kos'] ?>
                                    </h5>
                                    <span class="btn-available mb-3" style="border-radius: 4px;">
                                        <?php echo $popular['tipe_kos'] ?></span>
                                    <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                        <?php echo $popular['alamat'] ?>
                                    </p>

                                    <p class="card-text" style="font-weight: 600;">
                                        <?php echo $popular['avg_rating'] ? $popular['avg_rating'] : 0 ?>/5
                                        (<?php echo $popular['review_count'] ?>)
                                    </p>
                                    <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                        IDR
                                        <?php
                                        $arr = $popular['waktu_penyewaan'];
                                        $array = explode(',', $arr);
                                        $array = array_reverse($array);

                                        foreach ($array as $value) {
                                            switch ($value) {
                                                case 'Bulanan':
                                                    echo number_format($popular['harga'], 0, ',', '.');
                                                    break 2;
                                                case 'Harian':
                                                    echo number_format($popular['harga_hari'], 0, ',', '.');
                                                    break 2;
                                                case 'Mingguan':
                                                    echo number_format($popular['harga_minggu'], 0, ',', '.');
                                                    break 2;
                                                default:
                                                    echo number_format($popular['harga'], 0, ',', '.');
                                                    break;
                                            }
                                        }
                                        ?>
                                        <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                            <?php
                                            $arr = $popular['waktu_penyewaan'];
                                            $array = explode(',', $arr);
                                            $array = array_reverse($array);

                                            foreach ($array as $value) {
                                                switch ($value) {
                                                    case 'Bulanan':
                                                        echo "Bulanan";
                                                        break 2;
                                                    case 'Harian':
                                                        echo "Harian";
                                                        break 2;
                                                    case 'Mingguan':
                                                        echo "Mingguan";
                                                        break 2;
                                                    default:
                                                        echo "Bulanan";
                                                        break;
                                                }
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="popular">
                        <button type="button" class="btn btn-light btn-wide" style="color: #007bff; font-weight: 600;">
                            Lihat Semua <i class="fas fa-angle-right"></i>
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
                    <h2>Kost Terbaik di Dekatmu</h2>
                    <p>Memberikan Anda rekomendasi kos-kosan yang cepat dan mudah hanya di Re-kost.</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div id="cityContainer">
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Blindungan</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Tamanan</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block">Wonosari</button>
                    <button type="button" class="btn btn-outline-primary mr-3 d-inline-block" id="showMore">10+</button>
                </div>
                <a href="best">
                    <div>
                        <button type="button" class="btn btn-custom d-inline-block" style="font-weight: 400;">Lihat
                            Semua <i class="fas fa-angle-right"></i></button>
                    </div>
                </a>
            </div>
            <div class="row scroll-container">
                <?php foreach ($data['best'] as $best): ?>
                    <div class="col-md-4 mb-5">
                        <a href="<?= BASEURL . 'detailkos/' . $best["id_kos"] ?>" class="card-link">
                            <div class="card">
                                <?php
                                $path = $best["id_kos"] . '/foto_depan.jpg';
                                $absolutePath = uploads($path);
                                if (file_exists($absolutePath)) {
                                ?>
                                    <img src="<?= asset('uploads/' . $path) ?>" class="card-img-top" alt="Kost Image">
                                <?php
                                } else {

                                ?>
                                    <img src="<?= asset(path: 'default/default.jpg') ?>" class="card-img-top"
                                        alt="No Image Available">
                                <?php
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">
                                        <?php echo $best['nama_kos'] ?>
                                    </h5>
                                    <span class="btn-available mb-3" style="border-radius: 4px;">
                                        <?php echo $best['tipe_kos'] ?></span>
                                    <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                        <?php echo $best['alamat'] ?></p>
                                    <p class="card-text" style="font-weight: 600;">
                                        <?php echo $best['avg_rating'] ? $best['avg_rating'] : 0 ?>/5
                                        (<?php echo $best['review_count'] ?>)
                                    </p>
                                    <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                        IDR
                                        <?php
                                        $arr = $best['waktu_penyewaan'];
                                        $array = explode(',', $arr);
                                        $array = array_reverse($array);

                                        foreach ($array as $value) {
                                            switch ($value) {
                                                case 'Bulanan':
                                                    echo number_format($best['harga'], 0, ',', '.');
                                                    break 2;
                                                case 'Harian':
                                                    echo number_format($best['harga_hari'], 0, ',', '.');
                                                    break 2;
                                                case 'Mingguan':
                                                    echo number_format($best['harga_minggu'], 0, ',', '.');
                                                    break 2;
                                                default:
                                                    echo number_format($best['harga'], 0, ',', '.');
                                                    break;
                                            }
                                        }
                                        ?>
                                        <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                            <?php
                                            $arr = $best['waktu_penyewaan'];
                                            $arrayB = explode(',', $arr);
                                            $arrayB = array_reverse($arrayB);

                                            foreach ($arrayB as $value) {
                                                switch ($value) {
                                                    case 'Bulanan':
                                                        echo "Bulanan";
                                                        break 2;
                                                    case 'Harian':
                                                        echo "Harian";
                                                        break 2;
                                                    case 'Mingguan':
                                                        echo "Mingguan";
                                                        break 2;
                                                    default:
                                                        echo "Bulanan";
                                                        break;
                                                }
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="strategically-located">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Kost Strategis Dekat Kampus/Kantor</h2>
                        <p>Memberikan Anda rekomendasi kos-kosan yang cepat dan mudah hanya di Re-kost.</p>
                    </div>
                    <a href="campus">
                        <button type="button" class="btn btn-custom" style="font-weight: 400;">Lihat Semua <i
                                class="fas fa-angle-right"></i></button>
                    </a>
                </div>
            </div>
            <div class="row scroll-container">
                <?php foreach ($data['campus'] as $campus): ?>
                    <div class="col-md-4 mb-5">
                        <a href="<?= BASEURL . 'detailkos/' . $campus["id_kos"] ?>" class="card-link">
                            <div class="card">
                                <?php
                                $path = $campus["id_kos"] . '/foto_depan.jpg';
                                $absolutePath = uploads($path);
                                if (file_exists($absolutePath)) {
                                ?>
                                    <img src="<?= asset('uploads/' . $path) ?>" class="card-img-top" alt="Kost Image">
                                <?php
                                } else {

                                ?>
                                    <img src="<?= asset(path: 'default/default.jpg') ?>" class="card-img-top"
                                        alt="No Image Available">
                                <?php
                                }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 20px; font-weight: bold;">
                                        <?php echo $campus['nama_kos'] ?>
                                    </h5>
                                    <span class="btn-available mb-3" style="border-radius: 4px;">
                                        <?php echo $campus['tipe_kos'] ?></span>
                                    <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                        <?php echo $campus['alamat'] ?></p>
                                    <p class="card-text" style="font-weight: 600;">
                                        <?php echo $campus['avg_rating'] ? $campus['avg_rating'] : 0 ?>/5
                                        (<?php echo $campus['review_count'] ?>)
                                    </p>
                                    <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                        IDR
                                        <?php
                                        $arr = $campus['waktu_penyewaan'];
                                        $array = explode(',', $arr);
                                        $array = array_reverse($array);

                                        foreach ($array as $value) {
                                            switch ($value) {
                                                case 'Bulanan':
                                                    echo number_format($campus['harga'], 0, ',', '.');
                                                    break 2;
                                                case 'Harian':
                                                    echo number_format($campus['harga_hari'], 0, ',', '.');
                                                    break 2;
                                                case 'Mingguan':
                                                    echo number_format($campus['harga_minggu'], 0, ',', '.');
                                                    break 2;
                                                default:
                                                    echo number_format($campus['harga'], 0, ',', '.');
                                                    break;
                                            }
                                        }
                                        ?>
                                        <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                            <?php
                                            $arr = $campus['waktu_penyewaan'];
                                            $array = explode(',', $arr);
                                            $array = array_reverse($array);

                                            foreach ($array as $value) {
                                                switch ($value) {
                                                    case 'Bulanan':
                                                        echo "Bulanan";
                                                        break 2;
                                                    case 'Harian':
                                                        echo "Harian";
                                                        break 2;
                                                    case 'Mingguan':
                                                        echo "Mingguan";
                                                        break 2;
                                                    default:
                                                        echo "Bulanan";
                                                        break;
                                                }
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <section id="service" class="customer-says">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>Ulasan Pelanggan Kami Tentang Re-Kost</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-wrapper d-flex">
                        <?php foreach ($data['rating_aplikasi'] as $rating): ?>
                            <div class="card mx-3 mb-4" style="width: 300px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="<?= asset('uploads/' . $rating['id_user'] . '/' . $rating['img']) ?>" class="rounded-circle mr-3"
                                            alt="User Profile">
                                        <div>
                                            <h5 class="card-title" style="margin-bottom: 5px;">
                                                <?php echo $rating['nama_user'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="mb-3" style="color: #FFC107;">
                                        <?php
                                        $ratingValue = $rating['rating'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $ratingValue) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p class="card-text"><?php echo $rating['review'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                        <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/Vector.svg') ?>"
                            alt="Circle Image" class="rounded-circle" style="width: 50px; height: 50px;">
                        <div class="star-rating mt-2" id="rating-container">
                            <i class="fas fa-star inactive" data-rating="1"></i>
                            <i class="fas fa-star inactive" data-rating="2"></i>
                            <i class="fas fa-star inactive" data-rating="3"></i>
                            <i class="fas fa-star inactive" data-rating="4"></i>
                            <i class="fas fa-star inactive" data-rating="5"></i>
                        </div>
                    </div>

                    <form id="ulasanForm" method="post" action="<?= BASEURL; ?>addulasan" class="form-inline mt-4"
                        onsubmit="return validateForm()">
                        <input type="hidden" id="ratingInput" name="rating">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tuliskan ulasan anda disini...."
                                id="reviewInput" name="reviewInput">
                            <button class="btn" style="background: none; border: none; color: #303030; cursor: pointer;"
                                type="submit">
                                <i class="fas fa-paper-plane send-message"></i>
                            </button>
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
                    <p style="margin-bottom: 52px;">Masukkan email Anda di bawah ini untuk menjadi orang pertama yang
                        mengetahui koleksi baru dan peluncuran produk</p>
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
    <a href="chats" class="float-button" onclick="toggleChat()">
        <i class="fas fa-comment-dots"></i>
    </a>
    </div>
    </div>
    <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script> -->
    <script src="<?= asset('js/navbar.js') ?>"></script>
    <script src="<?= asset('js/StarRating.js') ?>"></script>
    <script src="<?= asset('js/AddArea.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script> -->
</body>

</html>