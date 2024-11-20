<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        body {
            background-color: #F9FCFF;
            font-family: 'Arial', sans-serif;
        }

        h2 {
            text-align: center;
        }

        .sidebar {
            height: 100vh;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #000;
            font-weight: 500;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 70px;
        }

        .navbar .navbar-nav .nav-link {
            color: #000;
        }

        .navbar .nav-link i {
            font-size: 1.5rem;
        }

        .navbar .nav-link {
            padding: 0.5rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .badge {
            padding: 6px 12px;
            font-size: 0.875rem;
            border-radius: 5px;
        }

        table th,
        table td {
            border: 1px solid rgba(0, 0, 0, 0.3) !important;
            padding: 8px;
            text-align: center;
        }

        table thead {
            background-color: #343a40;
            color: #fff;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-left: auto;
            opacity: 0.7;
        }

        .icon-box i {
            font-size: 1.5rem;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <div class="text-center mb-4">
                <img alt="Logo" height="50" src="<?= asset('img/logo.png') ?>" width="170" />
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="dashboard" id="dashboardLink">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a class="nav-link active" href="acceptance" id="persetujuanLink">
                    <i class="fas fa-check-circle"></i> Persetujuan Kost
                </a>
                <button class="btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dataPenggunaCollapse" aria-expanded="false" aria-controls="dataPenggunaCollapse">
                    <i class="bi bi-people"></i> Data Pengguna
                </button>
                <div class="collapse" id="dataPenggunaCollapse">
                    <div class="mt-2 ps-3">
                        <a href="pencarikos" class="nav-link">Pencari Kos</a>
                        <a href="pemilikkos" class="nav-link">Pemilik Kos</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="content flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <span class="navbar-text me-auto fw-bold" style="color: #000; font-size: 18px;">
                        Selamat Datang, Admin!
                    </span>
                </div>
            </nav>
            <div class="container mt-4">
                <h2>Daftar Persetujuan Kos</h2>
                <div class="table-responsive mt-4">
                    <table id="userTable" class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Pemilik</th>
                                <th>Email</th>
                                <th>Nama Kos</th>
                                <th>Alamat</th>
                                <th>Kota Asal</th>
                                <th>No Telephone</th>
                                <!-- <th>KTP</th> -->
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $user) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['nama_kos'] ?></td>
                                    <td><?= $user['alamat'] ?></td>
                                    <td><?= $user['kota_asal'] ?></td>
                                    <td><?= $user['number_phone'] ?></td>
                                    <td>
                                        <span class="badge <?= $user['status'] == 'pending' ? 'bg-warning' : ($user['status'] == 'aktif' ? 'bg-success' : 'bg-danger') ?>">
                                            <?= $user['status'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $user['id_user'] ?>">Detail</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="detailModal<?= $user['id_user'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $user['id_user'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel<?= $user['id_user'] ?>">Detail Kos: <?= $user['nama_kos'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama Pemilik:</strong> <?= $user['nama'] ?></p>
                                                <p><strong>Email:</strong> <?= $user['email'] ?></p>
                                                <p><strong>Nama Kos:</strong> <?= $user['nama_kos'] ?></p>
                                                <p><strong>Alamat:</strong> <?= $user['alamat'] ?></p>
                                                <p><strong>Kota Asal:</strong> <?= $user['kota_asal'] ?></p>
                                                <p><strong>Nomor Telepon:</strong> <?= $user['number_phone'] ?></p>
                                                <p><strong>Status:</strong> <?= $user['status'] ?></p>
                                                <p><strong>KTP:</strong> <img src="<?= asset('uploads/' . $user['id_user'] . '/Lampiran.jpg') ?>" alt="thumbnail" class="thumbnail w-100"></p>
                                                <form action="acceptance " method="POST" id="statusForm<?= $user['id_user'] ?>">
                                                    <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                                                    <button type="submit" name="status" value="aktif" class="btn btn-success btn-sm">Setujui</button>
                                                    <button type="submit" name="status" value="blokir" class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>