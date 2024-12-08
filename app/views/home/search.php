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
            width: 350px;
            height: 500px;
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
                        <div class="dropdown d-inline-block mr-3">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-map-marker-alt"></i> <span id="lokasiSelected">Lokasi</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownLokasi">
                                <button type="button" class="dropdown-item" data-value="Blindungan">Blindungan</button>
                                <button type="button" class="dropdown-item" data-value="Tamanan">Tamanan</button>
                                <button type="button" class="dropdown-item" data-value="Tamansari">Tamansari</button>
                                <button type="button" class="dropdown-item" data-value="Sumbersari">Sumbersari</button>
                                <button type="button" class="dropdown-item" data-value="Tapen">Tapen</button>
                                <button type="button" class="dropdown-item" data-value="Sempol">Sempol</button>
                            </div>
                            <input type="hidden" name="location" id="locationInput">
                        </div>

                        <!-- Harga Dropdown -->
                        <div class="dropdown d-inline-block mr-3">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownHarga" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-dollar-sign"></i> <span id="hargaSelected">Harga</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownHarga">
                                <button type="button" class="dropdown-item" data-value="0-1000000">Tertinggi ke Terendah</button>
                                <button type="button" class="dropdown-item" data-value="1000000-2000000">Terendah ke Tertinggi</button>
                            </div>
                            <input type="hidden" name="cost" id="costInput">
                        </div>

                        <!-- Urutkan Dropdown (No form element) -->
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownUrutkan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-filter"></i> Urutkan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownUrutkan">
                                <a class="dropdown-item" href="#">Popularitas</a>
                                <a class="dropdown-item" href="#">Terbaru</a>
                            </div>
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
            <div class="row" style="margin-top: 32px;">
                <?php if (!empty($data['search'])) : ?>
                    <div class="row">
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
                                                style="border-radius: 4px;"><?= htmlspecialchars($kos['tipe_kos'], ENT_QUOTES, 'UTF-8') ?></span>
                                            <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                                IDR <?= number_format($kos['harga'], 0, ',', '.') ?>
                                                <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">
                                                    <?= htmlspecialchars($kos['waktu_penyewaan'], ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                            </p>
                                            <a class="btn-order" href="<?= BASEURL . 'detailkos/' . $kos['id_kos'] ?>">Pesan sekarang</a>
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
    document.querySelectorAll('.dropdown-menu button').forEach(button => {
        button.addEventListener('click', function() {
            const dropdown = this.closest('.dropdown');
            const inputId = dropdown.querySelector('input[type="hidden"]').id;
            const value = this.getAttribute('data-value');
            const selectedSpan = dropdown.querySelector('button span');

            document.getElementById(inputId).value = value;

            const buttonText = this.innerText;
            selectedSpan.innerText = buttonText;

            document.getElementById('filterForm').submit();
        });
    });

    let selectedHarga = [];
    document.querySelectorAll('#dropdownHarga .dropdown-item').forEach(button => {
        button.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const selectedSpan = document.getElementById('hargaSelected');

            if (!selectedHarga.includes(value)) {
                selectedHarga.push(value);
                selectedSpan.innerText = selectedHarga.join(', ');
            } else {
                selectedHarga = selectedHarga.filter(item => item !== value);
                selectedSpan.innerText = selectedHarga.join(', ') || 'Harga';
            }

            document.getElementById('costInput').value = selectedHarga.join(', ');

            document.getElementById('filterForm').submit();
        });
    });

    window.history.replaceState(null, document.title, window.location.href);

    window.addEventListener('popstate', function() {
        window.location.href = '';
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>