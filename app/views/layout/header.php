<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title><?php echo $title ?></title>
    <style>
        @media (max-width: 768px) {
            .nav-item {
                margin-right: 10px;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }
        }

        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        .navbar-nav.ml-auto {
            justify-content: flex-end;
        }

        .nav-item {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 600;
            color: #4a4a4a;
            font-size: 16px;
        }

        .navbar-toggler {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white ">
            <a class="navbar-brand" href="#">
                <img src="<?= asset('img/logo.png') ?>" alt="Re-Kost Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <?php if ($role === 'pemilik kos'): ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASEURL; ?>#home">Home <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>#graph">Graph</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>#service">Rating</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASEURL; ?>#home">Home <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>#bookings">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>#service">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>#contact">Contact</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                    <div class="navbar-nav ml-auto mx-4 d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="notifDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
                                <?php if ($_SESSION['user']['role'] === 'pemilik kos'): ?>
                                    <?php if (empty($data['notifikasiPemilik'])): ?>
                                        <div class="dropdown-item text-center">Tidak ada Notifikasi</div>
                                    <?php else: ?>
                                        <?php foreach ($data['notifikasiPemilik'] as $notif): ?>
                                            <div class="dropdown-item">
                                                <?php if (isset($notif['sisa_hari']) && $notif['sisa_hari'] <= 3 && $notif['sisa_hari'] >= 0): ?>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-exclamation-circle text-warning mr-2"></i>
                                                        <div>
                                                            <small class="text-muted">Masa sewa penyewa </small>
                                                            <p class="mb-0">
                                                                <?= $notif['nama_penyewa'] ?> akan berakhir dalam
                                                                <?= $notif['sisa_hari'] == 0 ? 'Hari ini' : "dalam {$notif['sisa_hari']} hari" ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-check-circle text-success mr-2"></i>
                                                    <div>
                                                        <small class="text-muted">
                                                            <?php
                                                            if (isset($notif['tanggal_penyewaan'])) {
                                                                $date = new DateTime($notif['tanggal_penyewaan']);
                                                                echo "Penyewa baru pada " . $date->format('d F Y');
                                                            } else {
                                                                echo "Penyewa baru";
                                                            }
                                                            ?>
                                                        </small>
                                                        <p class="mb-0">
                                                            <?= $notif['nama_penyewa'] ?> telah menyewa <?= $notif['nama_kos'] ?> selama
                                                            <?= $notif['durasi'] ?> hari
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-money-check-alt text-info mr-2"></i>
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
                                                                    $formattedDate = $date1->format('d F Y');
                                                                    echo "Pembayaran pada tanggal: {$formattedDate}";
                                                                }
                                                            }
                                                            ?>
                                                        </small>
                                                        <p class="mb-0">
                                                            Pembayaran <?= $notif['nama_penyewa'] ?> Rp
                                                            <?= number_format($notif['harga'], 0, ',', '.') ?> telah diterima
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="dropdown-divider"></div>
                                        <?php endforeach; ?>
                                        <a class="dropdown-item text-center" href="<?= BASEURL; ?>/riwayat"></a>
                                    <?php endif; ?>


                                <?php else: ?>
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
                                                            <?= number_format($notif['harga'], 0, ',', '.') ?> telah dikonfirmasi
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                        <?php endforeach; ?>
                                        <a class="dropdown-item text-center" href="<?= BASEURL; ?>riwayat">Lihat semua Riwayat
                                            pembayaran</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/Vector.svg') ?>"
                                    class="rounded-circle" alt="Profile Image" width="40px" height="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="<?= BASEURL; ?>profile">Profile</a>
                                <a class="dropdown-item" href="<?= BASEURL; ?>riwayat">Riwayat</a>
                                <?php if ($_SESSION['user']['role'] === 'pemilik kos'): ?>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>datakos">Data Kost</a>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>datakamar">Data Kamar</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= BASEURL; ?>logout">Logout</a>
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