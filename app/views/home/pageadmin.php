<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re-Kost</title>
    <link rel="stylesheet" href="<?= asset('css/landingPage.css') ?>">
    <script src="<?= asset('js/navbar.js') ?>"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 50px;
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

                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                    <div class="navbar-nav ml-auto mx-4 d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/user.png') ?>" class="rounded-circle" alt="Profile Image" width="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="<?= BASEURL; ?>profile">Profile</a>
                                <?php if ($_SESSION['user']['role'] === 'pemilik kos'): ?>
                                    <a class="dropdown-item" href="#services">Profile Kost</a>
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
    <section id="acceptance" class="table">
        <div class="container mt-5">
            <h2 class="mb-4">Daftar Pendaftaran Kos</h2>
            <table id="example-table" class="table data-table">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>Nama Kos</th>
                        <th>Lokasi</th>
                        <th>Jumlah Kamar</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mafir</td>
                        <td>Kos Putri</td>
                        <td>Bondowoso</td>
                        <td>1</td>
                        <td>2024-11-01</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-success btn-sm">Setujui</button>
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Aurel</td>
                        <td>Kos Muslimah</td>
                        <td>Jember</td>
                        <td>5</td>
                        <td>2024-11-02</td>
                        <td><span class="badge bg-success" style="color: white;">Disetujui</span></td>
                        <td>
                            <button class="btn btn-secondary btn-sm">Setujui</button>
                            <button class="btn btn-secondary btn-sm">Tolak</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = new DataTable('#example-table');
            // $('#example-table').DataTable({
            //     // Opsional: Konfigurasi tambahan
            //     "paging": true,
            //     "searching": true,
            //     "ordering": true,
            //     "info": true,
            //     "language": {
            //         "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" // Untuk bahasa Indonesia
            //     }
            // });
        });
    </script>
</body>

</html>