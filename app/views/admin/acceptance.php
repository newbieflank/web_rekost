<html>

<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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

        table tr {
            text-align: center;
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

        .table-responsive {
            overflow-x: auto;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 12px;
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
                <a class="nav-link active" href="accpetance" id="persetujuanLink">
                    <i class="fas fa-check-circle"></i> Persetujuan Kost
                </a>
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1" id="daftarPenggunaBtn">
                    <i class="bi bi-people"></i> Data Pengguna
                </button>
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="p-3">
                            <div class="nav flex-column">
                                <a href="#" class="nav-link w-100 mb-2" id="pencariKosLink">
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
                <div class="table-responsive mt-4">
                    <h2>Daftar Persetujuan Kos</h2>
                    <table id="userTable" class="table table-bordered">
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
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approvalModal">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Aurel</td>
                                <td>Kos Muslimah</td>
                                <td>Jember</td>
                                <td>5</td>
                                <td>2024-11-02</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approvalModal">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvalModalLabel">Persetujuan Kos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda ingin menyetujui atau menolak ajuan kos ini?</p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success">Setujui</button>
                        <button class="btn btn-danger">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();

            // Menambahkan event listener untuk tombol "Data Pengguna"
            $('#daftarPenggunaBtn').click(function() {
                // Menghapus class active dari semua tombol
                $('.nav-link').removeClass('active');

                // Menambahkan class active ke tombol yang diklik
                $(this).addClass('active');
            });

            // Menambahkan event listener untuk sidebar link
            const navLinks = document.querySelectorAll('.nav-link, .btn');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>