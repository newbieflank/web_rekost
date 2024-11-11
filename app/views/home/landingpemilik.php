<html>

<head>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= asset('css/landingpemilik.css') ?>">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f8fb !important;
        }

        .dashboard {
            background-color: #4a90e2;
            color: #ffffff;
            padding: 2rem;
            height: 300px;
            text-align: left;
            position: relative;
            z-index: 1;
            border-bottom-left-radius: 22px;
            border-bottom-right-radius: 22px;
        }

        .dashboard h1 {
            font-size: 32px;
            margin-bottom: 0.5rem;
        }

        .dashboard p {
            font-size: 20px;
        }

        .rating-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
            width: 250px;
            padding: 1rem;
            background-color: #f8f9fa;
        }

        .rating-card h5 {
            font-size: 0.9rem;
        }

        .rating-card p {
            font-size: 0.8rem;
        }

        .overlap-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
            position: relative;
            overflow: hidden;
        }

        .overlap-card::before {
            content: "";
            background-image: var(--url);
            background-size: 100px;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1;
            position: absolute;
            top: 50%;
            left: 90%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
        }

        .overlap-card h5 {
            font-size: 24px;
            text-align: left;
        }

        .overlap-card p {
            font-size: 16px;
            text-align: left;
        }


        .overlap-container {
            margin-top: -7rem;
            position: relative;
            z-index: 2;
        }

        .overlap-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../layout/header.php'; ?>
    <section class="dashboard">
        <h2 style="font-weight: bold;">Dashboard</h2>
        <p>Menampilkan ringkasan pendapatan, pengeluaran, dan rekap keuangan kost secara menyeluruh.</p>
    </section>
    <section class="container overlap-container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card overlap-card" style="--url: url('https://fontawesome.com/icons/chart-mixed-up-circle-dollar?f=duotone&s=solid  ')">
                    <div class="card-body">
                        <h5>Pendapatan</h5>
                        <p>Pendapatan yang didapatkan Bulan Januari</p>
                        <p style="font-size: 40px; font-weight: 600; text-align:center">Rp 1.000.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card overlap-card" style="--url: url('https://img.icons8.com/ios-filled/100/000000/line-chart.png')">
                    <div class="card-body">
                        <h5>Pengeluaran</h5>
                        <p>Pengeluaran yang dikeluarkan Bulan Januari</p>
                        <p style="font-size: 40px; font-weight: 600; text-align:center">Rp 1.000.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card overlap-card" style="--url: url('https://img.icons8.com/ios-filled/100/000000/line-chart.png')">
                    <div class="card-body">
                        <h5>Rating</h5>
                        <p>Ulasan yang diberikan untuk kost ini</p>
                        <p style="font-size: 40px; font-weight: 600; text-align:center">Rp 1.000.000</p>
                    </div>
                </div>
            </div>
    </section>
    <section id="graph" class="statistik" style="background-color: #f4f8fb; padding: 40px 0;">
        <div class="container-fluid">
            <div class="header-row d-flex align-items-center justify-content-between">
                <div class="text-content mx-4">
                    <h2>Statistik Keuangan</h2>
                    <p>Menampilkan ringkasan statistik keuangan untuk memberikan gambaran lengkap tentang pendapatan dan pengeluaran bulanan.</p>
                </div>
                <div class="filter mx-">
                    <label>
                        <input type="radio" name="keuanganFilter" value="pendapatan" checked>
                        Pendapatan
                    </label>
                    <label>
                        <input type="radio" name="keuanganFilter" value="pengeluaran">
                        Pengeluaran
                    </label>
                </div>
            </div>
            <div class="chart-wrapper">
                <canvas id="keuanganChart"></canvas>
            </div>
        </div>
    </section>
    <section id="service" class="customer-says">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>What our Customer Says About Re-Kost</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-wrapper d-flex">
                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>

                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>
                        <div class="card mx-3 mb-4 rating-card" style="width: 250px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= asset('img/user.png') ?>" class="rounded-circle mr-3" alt="User Profile">
                                    <div>
                                        <h5 class="card-title" style="margin-bottom: 5px;">Arlene McCoy</h5>
                                        <p class="card-text" style="margin-top: 0;"><i class="fas fa-map-marker-alt"></i> Surabaya</p>
                                    </div>
                                </div>
                                <div class="mb-3" style="color: #FFC107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="card-text">Aplikasi Re-Kost sangat membantu saya dalam menemukan kost yang sesuai dengan budget dan preferensi saya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include __DIR__ . '/../layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Dataset 1',
                    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    backgroundColor: '#000000',
                },
                {
                    label: 'Dataset 2',
                    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    backgroundColor: '#FFC107',
                },
            ]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false,
                    }
                }
            }
        };
        const ctx = document.getElementById('keuanganChart');

        new Chart(ctx, config);
        const DATA_COUNT = 7;
        const NUMBER_CFG = {
            count: DATA_COUNT,
            min: -100,
            max: 100
        };
    </script>
</body>
<script src="<? asset('js/file.js') ?>"></script>

</html>