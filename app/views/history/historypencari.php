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

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        table th,
        table td {
            padding: 12px;
            text-align: center;
        }

        table thead {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="content flex-grow-1">
            <?php include __DIR__ . '/../layout/header.php'; ?>
            <div class="container mt-4">
                <h2>Riwayat Transaksi</h2>
                <div class="table-responsive mt-4">
                    <table id="userTable" class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Id Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Waktu Penyewaan</th>
                                <th>Harga</th>
                                <th>Bukti Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($riwayat as $transaksi) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $transaksi['id_penyewaan'] ?></td>
                                    <td><?= $transaksi['tanggal_penyewaan'] ?></td>
                                    <td><?= $transaksi['waktu_penyewaan'] ?></td>
                                    <td><?= $transaksi['harga_kos'] ?></td>
                                    <td>
                                        <a href="<?= BASEURL; ?>/uploads/id_kost<?= $transaksi['id_penyewaan'] ?>" class="btn btn-sm btn-primary">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                </tr>
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
            $('#userTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>