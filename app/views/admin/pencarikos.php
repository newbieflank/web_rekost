<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F9FCFF;
            font-family: 'Arial', sans-serif;
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

        h2 {
            margin-bottom: 24px;
            text-align: center;
            font-size: 32px;
            font-weight: 400;
        }

        table tr {
            text-align: center;
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

        .table-responsive {
            overflow-x: auto;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 12px;
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

        h2 {
            margin-bottom: 24px;
            text-align: center;
            font-size: 32px;
            font-weight: 400;
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
                <a class="nav-link" href="accpetance" id="persetujuanLink">
                    <i class="fas fa-check-circle"></i> Persetujuan Kost
                </a>
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1" id="daftarPenggunaBtn">
                    <i class="bi bi-people"></i> Data Pengguna
                </button>
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="p-3">
                            <div class="nav flex-column">
                                <a href="#" class="nav-link active w-100 mb-2" id="pencariKosLink">
                                    <i class="bi bi-person-fill"></i> Pencari Kos
                                </a>
                                <a href="#" class="nav-link w-100" id="pemilikKosLink">
                                    <i class="bi bi-person-bounding-box"></i> Pemilik Kos
                                </a>
                            </div>
                        </div>
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
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-bell"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container mt-4">
                <h2>Daftar Pencari Kos</h2>
                <div class="table-responsive">
                    <table id="pencariKosTable" class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Tanggal Registrasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $pencariKos = [
                            //     [
                            //         "no" => 1,
                            //         "nama" => "Mafira Aurelia",
                            //         "email" => "mafira@example.com",
                            //         "telepon" => "08123456789",
                            //         "alamat" => "Jember",
                            //         "tanggal_lahir" => "2024-11-01"
                            //     ],
                            //     [
                            //         "no" => 2,
                            //         "nama" => "Aurel Salsabila",
                            //         "email" => "aurel@example.com",
                            //         "telepon" => "08198765432",
                            //         "alamat" => "Bondowoso",
                            //         "tanggal_lahir" => "2024-11-02"
                            //     ]
                            // ];
                            // foreach ($pencariKos as $pencari) {
                            //     echo "<tr>";
                            //     echo "<td>" . $pencari['no'] . "</td>";
                            //     echo "<td>" . $pencari['nama'] . "</td>";
                            //     echo "<td>" . $pencari['email'] . "</td>";
                            //     echo "<td>" . $pencari['telepon'] . "</td>";
                            //     echo "<td>" . $pencari['alamat'] . "</td>";
                            //     echo "<td>" . $pencari['tanggal_lahir'] . "</td>" . $pencari['email'] . "</td>";
                            //     echo "</tr>";
                            // }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pencariKosTable').DataTable();
        });
    </script>
</body>

</html>