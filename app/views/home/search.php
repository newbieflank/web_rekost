<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('css/popular.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            padding-top: 0;
        }

        .card {
            width: 300px;
            height: 500px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
        }

        .card-body {
            flex-grow: 1;
            padding: 15px;
            overflow: hidden;
        }

        .no-results {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .no-results p {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333;
        }
    </style>
</head>

<body>
    <section class="populer">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-0 p-4">
                    <h2 style="font-size: 32px; font-weight: bold; margin-top: 24px">
                        Tentukan KosMu Sekarang!
                    </h2>
                    <p style="font-size: 16px; font-weight: normal; color: #5F5F5F">Temukan kost terpopuler dengan
                        fasilitas terbaik dan lokasi strategis hanya di Re-Kost.</p>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <div class="dropdown d-inline-block mr-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-map-marker-alt"></i> Lokasi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownLokasi">
                            <a class="dropdown-item" href="#">Blindungan</a>
                            <a class="dropdown-item" href="#">Tamanan</a>
                            <a class="dropdown-item" href="#">Tamansari</a>
                            <a class="dropdown-item" href="#">Tapen</a>
                            <a class="dropdown-item" href="#">Sempol</a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block mr-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownHarga"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-dollar-sign"></i> Harga
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownHarga">
                            <a class="dropdown-item" href="#">Tertinggi ke Terendah</a>
                            <a class="dropdown-item" href="#">Terendah ke Tertinggi</a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownUrutkan"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i> Urutkan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownUrutkan">
                            <a class="dropdown-item" href="#">Popularitas</a>
                            <a class="dropdown-item" href="#">Terbaru</a>
                        </div>
                    </div>
                </div>
                <div class="position-relative" style="width: 100%; max-width: 400px;">
                    <input type="text" class="form-control search-input" placeholder="Search Boarding House"
                        aria-label="Search Boarding House">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            <div class="row" style="margin-top: 32px;">
                <?php if (!empty($data['search'])) : ?>
                    <?php foreach ($data['search'] as $kos) : ?>
                        <div class="col-md-3 p-3 mb-5">
                            <a href="<?= BASEURL . 'detailkos/' . $kos['id_kos'] ?>" class="card-link">
                                <div class="card">
                                    <img src="<?= asset('img/home1.png') ?>" class="card-img-top" height="200" width="300" />
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($kos['nama_kos'], ENT_QUOTES, 'UTF-8') ?></h5>
                                        <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                            <?= htmlspecialchars($kos['alamat'], ENT_QUOTES, 'UTF-8') ?></p>
                                        <p class="card-text" style="font-weight: 600;"><?= $kos['avg_rating'] ?>/5
                                            (<?= $kos['review_count'] ?>)</p>
                                        <span class="btn-available"
                                            style="border-radius: 4px;"><?= htmlspecialchars($kos['status_kamar'], ENT_QUOTES, 'UTF-8') ?></span>
                                        <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                            IDR <?= number_format($kos['harga'], 0, ',', '.') ?>
                                            <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">
                                                /<?= htmlspecialchars($kos['waktu_penyewaan'], ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </p>
                                        <a class="btn-order" href="<?= BASEURL . 'detailkos/' . $kos['id_kos'] ?>">Pesan sekarang</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="no-results">
                        <p>Kos Yang Anda Cari Tidak Ada</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
</body>