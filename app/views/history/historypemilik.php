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

    <body>
        <div class="d-flex">
            <div class="content flex-grow-1">
                <div class="container mt-4">
                    <h2>Riwayat Transaksi</h2>
                    <div class="table-responsive mt-4">
                        <table id="userTable" class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Id Transaksi</th>
                                    <th>Id Kos</th>
                                    <th>Nama Pemilik</th>
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
                                        <td><?= $transaksi['id_kos'] ?></td>
                                        <td><?= $transaksi['nama'] ?></td>
                                        <td><?= $transaksi['tanggal_penyewaan'] ?></td>
                                        <td><?= $transaksi['waktu_penyewaan'] ?></td>
                                        <td><?= $transaksi['harga_kos'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $transaksi['id_kos'] ?>">Lihat Bukti</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="detailModal<?= $transaksi['id_kos'] ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $transaksi['id_kos'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel<?= $transaksi['id_kos'] ?>"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><img src="<?= asset('uploads/' . $transaksi['id_kos'] . '/Lampiran.jpg') ?>" alt="thumbnail" class="thumbnail w-100"></p>
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