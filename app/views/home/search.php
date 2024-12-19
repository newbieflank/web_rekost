<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?= asset('css/popular.css') ?>">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            padding-top: 0;
        }

        a {
            text-decoration: none;
        }

        .card {
            width: 80%;
            height: auto;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 15px;
        }

        .card-body {
            flex-grow: 1;
            padding: 15px;
            overflow: hidden;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card-text i.fas.fa-map-marker-alt,
        .card-text {
            color: #000;
        }

        .card-text strong {
            color: #000;
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

        .col-md-3 {
            flex: 1 1 calc(33.33% - 20px);
        }

        select.form-control {
            display: inline-block;
            width: 200px;
            max-width: 100%;
            padding: 0 20px;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        select.form-control:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        select.form-control::after {
            content: "▼";
            position: absolute;
            right: 10px;
            pointer-events: none;
        }

        select.form-control option {
            color: #333;
            background-color: #fff;
            padding: 5px 10px;
        }

        select+select {
            margin-left: 10px;
        }

        select.form-control option[hidden] {
            display: none;
        }

        .search-input {
            width: 100%;
            padding: 12px 50px 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 18px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            color: #888;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .search-icon:hover {
            color: #007bff;
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
                <form id="filterForm" method="POST" action="<?= BASEURL; ?>search">
                    <div class="d-flex mb-3">
                        <div class="d-inline-block mr-3 position-relative">
                            <select class="form-control btn btn-primary" id="dropdownLokasi">
                                <option value="" disabled selected hidden>Lokasi</option>
                                <option value="Blindungan">Blindungan</option>
                                <option value="Tamanan">Tamanan</option>
                                <option value="Tamansari">Tamansari</option>
                                <option value="Tapen">Tapen</option>
                                <option value="Sempol">Sempol</option>
                            </select>
                        </div>
                        <div class="d-inline-block mr-3 position-relative">
                            <select class="form-control btn btn-primary" id="dropdownHarga">
                                <option value="" disabled selected hidden>Harga</option>
                                <option value="high-to-low">Tertinggi ke Terendah</option>
                                <option value="low-to-high">Terendah ke Tertinggi</option>
                            </select>
                        </div>
                        <div class="d-inline-block position-relative">
                            <select class="form-control btn btn-primary" id="dropdownUrutkan">
                                <option value="" disabled selected hidden>Urutkan</option>
                                <option value="popularity">Popularitas</option>
                                <option value="newest">Terbaru</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" style="display: none;">Submit</button>
                </form>
                <div class="position-relative" style="width: 100%; max-width: 400px;">
                    <input type="text" class="form-control search-input" placeholder="Search Boarding House" aria-label="Search Boarding House">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            <div class="row mt-4">
                <?php if (!empty($data['search'])) : ?>
                    <div class="row row-cols-1 row-cols-md-4 g-3">
                        <?php foreach ($data['search'] as $kos) : ?>
                            <div class="col">
                                <a href="<?= BASEURL . 'detailkos/' . $kos['id_kos'] ?>" class="card-link text-decoration-none">
                                    <div class="card h-100">
                                        <?php
                                        $path = $kos["id_kos"] . '/foto_depan.jpg';
                                        $absolutePath = uploads($path);
                                        if (file_exists($absolutePath)) {
                                        ?>
                                            <img src="<?= asset('uploads/' . $path) ?>" class="card-img-top" alt="Kost Image">
                                        <?php
                                        } else {

                                        ?>
                                            <img src="<?= asset(path: 'default/default.jpg') ?>" class="card-img-top" alt="No Image Available">
                                        <?php
                                        }
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($kos['nama_kos'], ENT_QUOTES, 'UTF-8') ?></h5>
                                            <p class="card-text" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                                <?= htmlspecialchars($kos['alamat'], ENT_QUOTES, 'UTF-8') ?></p>
                                            <p class="card-text" style="font-weight: 600;">
                                                <?= $kos['avg_rating'] ?>/5 (<?= $kos['review_count'] ?>)
                                            </p>
                                            <span class="btn-available" style="border-radius: 4px;">
                                                <?= htmlspecialchars($kos['tipe_kos'], ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                                IDR
                                                <?php
                                                $arr = $kos['waktu_penyewaan'];
                                                $array = explode(',', $arr);
                                                $array = array_reverse($array);

                                                foreach ($array as $value) {
                                                    switch (trim($value)) {
                                                        case 'Bulanan':
                                                            echo number_format($kos['harga'], 0, ',', '.');
                                                            break 2;
                                                        case 'Harian':
                                                            echo number_format($kos['harga_hari'], 0, ',', '.');
                                                            break 2;
                                                        case 'Mingguan':
                                                            echo number_format($kos['harga_minggu'], 0, ',', '.');
                                                            break 2;
                                                        default:
                                                            echo number_format($kos['harga'], 0, ',', '.');
                                                            break;
                                                    }
                                                }
                                                ?>
                                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">
                                                    <?= htmlspecialchars($kos['waktu_penyewaan'], ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                            </p>
                                            <a class="btn-order" href="<?= BASEURL . 'detailkos/' . $kos["id_kos"] . '/konfirmasi' ?>">Pesan sekarang</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="no-results">
                        <p>No results found. Try adjusting your filters or search criteria.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>


    </section>



</body>
<script>
    document.getElementById('dropdownHarga').addEventListener('change', function() {
        const selectedValue = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('harga', selectedValue);
        window.location.href = currentUrl;
    });

    document.getElementById('dropdownUrutkan').addEventListener('change', function() {
        const selectedValue = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('urutkan', selectedValue);
        window.location.href = currentUrl;
    });

    document.getElementById('dropdownLokasi').addEventListener('change', function() {
        const selectedValue = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('lokasi', selectedValue);
        window.location.href = currentUrl;
    });

    window.addEventListener('DOMContentLoaded', function() {
        const currentUrl = new URL(window.location.href);

        const hargaParam = currentUrl.searchParams.get('harga');
        if (hargaParam) {
            const hargaDropdown = document.getElementById('dropdownHarga');
            hargaDropdown.value = hargaParam;
        }

        const urutkanParam = currentUrl.searchParams.get('urutkan');
        if (urutkanParam) {
            const urutkanDropdown = document.getElementById('dropdownUrutkan');
            urutkanDropdown.value = urutkanParam;
        }

        const lokasiParam = currentUrl.searchParams.get('lokasi');
        if (lokasiParam) {
            const lokasiDropdown = document.getElementById('dropdownLokasi');
            lokasiDropdown.value = lokasiParam;
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>