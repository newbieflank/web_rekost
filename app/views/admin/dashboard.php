<html>

<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #F9FCFF;
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: auto;
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


        .content {
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card .card-body .icon {
            font-size: 2rem;
            color: #6c757d;
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

        .card-body h5 {
            font-size: 20px;
            font-weight: 500;
            color: #343a40;
            margin-bottom: 10px;
        }

        .card-body h3 {
            font-size: 24px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
        }

        .card-body p {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .text-muted {
            color: #6c757d;
            font-size: 18px;
        }


        .chart-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                <a class="nav-link active" href="dashboard" id="dashboardLink">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a class="nav-link" href="acceptance" id="persetujuanLink">
                    <i class="fas fa-check-circle"></i> Persetujuan Kost
                </a>
                <button class="btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dataPenggunaCollapse" aria-expanded="false" aria-controls="dataPenggunaCollapse">
                    <i class="bi bi-people"></i> Data Pengguna
                </button>
                <div class="collapse" id="dataPenggunaCollapse">
                    <div class="mt-2 ps-3">
                        <a href="pencarikos.php" class="nav-link">Pencari Kos</a>
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
                <h2>Dashboard</h2>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5>Pemilik Kos</h5>
                                    <h5><?= $totalPemilikKos ?></h5>
                                    <p>Total Pemilik Kos</p>
                                </div>
                                <div class="icon-box bg-primary">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5>Pencari Kos</h5>
                                    <h5><?= $totalPencariKos ?></h5>
                                    <p>Total Pencari Kos</p>
                                </div>
                                <div class="icon-box bg-success">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5>Kos</h5>
                                    <h5><?= $totalKos ?></h5>
                                    <p>Total Kos</p>
                                </div>
                                <div class="icon-box bg-danger">
                                    <i class="fas fa-home text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5>Rating</h5>
                                    <h3><?= $totalRatingKos ?><span class="text-muted">/5</span></h3>
                                    <p>Total Rating Aplikasi</p>
                                </div>
                                <div class="icon-box bg-warning">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Grafik Pengguna</h5>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roleSelection" id="rolePemilik" value="pemilik" checked>
                                    <label class="form-check-label" for="rolePemilik">Pemilik Kos</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roleSelection" id="rolePencari" value="pencari">
                                    <label class="form-check-label" for="rolePencari">Pencari Kos</label>
                                </div>
                            </div>
                        </div>
                        <canvas id="userRegisterChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const navLinks = document.querySelectorAll('.nav-link, .btn');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(item => item.classList.remove('active'));

                this.classList.add('active');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data
        const chartPemilik = {
            labels: <?php echo json_encode($chartPemilik["date"]); ?>,
            counts: <?php echo json_encode($chartPemilik["count"]); ?>
        };
        const chartPencari = {
            labels: <?php echo json_encode($chartPencari["date"]); ?>,
            counts: <?php echo json_encode($chartPencari["count"]); ?>
        };

        const ctx = document.getElementById('userRegisterChart');
        let currentRole = 'pemilik';

        function getChartData(role) {
            return role === 'pemilik' ? chartPemilik : chartPencari;
        }

        function getChartColor(role) {
            return role === 'pemilik' ? {
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)'
            } : {
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)'
            };
        }

        const initialColor = getChartColor(currentRole);

        const chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: getChartData(currentRole).labels,
                datasets: [{
                    label: 'Grafik Pemilik Kos',
                    data: getChartData(currentRole).counts,
                    backgroundColor: initialColor.backgroundColor,
                    borderColor: initialColor.borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: false
                    }
                }
            }
        });

        function updateChart(role) {
            const newData = getChartData(role);
            const newColor = getChartColor(role);

            chartInstance.data.labels = newData.labels;
            chartInstance.data.datasets[0].data = newData.counts;
            chartInstance.data.datasets[0].label = `Grafik ${role === 'pemilik' ? 'Pemilik Kos' : 'Pencari Kos'}`;
            chartInstance.data.datasets[0].backgroundColor = newColor.backgroundColor;
            chartInstance.data.datasets[0].borderColor = newColor.borderColor;
            chartInstance.update();
        }

        // Event Listeners for Radio Buttons
        document.getElementById('rolePemilik').addEventListener('change', function() {
            if (this.checked) {
                currentRole = 'pemilik';
                updateChart(currentRole);
            }
        });

        document.getElementById('rolePencari').addEventListener('change', function() {
            if (this.checked) {
                currentRole = 'pencari';
                updateChart(currentRole);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>