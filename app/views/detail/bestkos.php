    <link rel="stylesheet" href="<?= asset('css/bestkos.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
            height: 550px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 20px;
        }

        .card-body {
            flex-grow: 1;
            padding: 15px;
            overflow: hidden;
        }
    </style>

    <body>
        <section class="best">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between align-items-start"
                        style="margin-top: 24px; margin-bottom: 24px;">
                        <div>
                            <h2 style="font-size: 32px; font-weight: bold; margin-top: 24px">Best Boarding House Options
                                Near You</h2>
                            <p style="font-size: 16px; font-weight: normal; color: #5F5F5F;">Providing you with quick and
                                convenient boarding house recommendations only at Re-kost.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                    <div class="d-flex overflow-auto mb-2 mb-md-0">
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Blindungan</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Tamanan</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Wonosari</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Tamansari</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Kampung Arab</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Sempol</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Tapen</button>
                    </div>
                    <div class="d-flex align-items-center">
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
                </div>
            </div>
            <div class="container-fluid">
                <div class="row" style="margin-top: 32px;">
                    <?php foreach ($data['best'] as $best): ?>
                        <div class="col-md-3 p-3 mb-5">
                            <a href="<?= BASEURL . 'detailkos/' . $best["id_kos"] ?>" class="card-link">
                                <div class="card">
                                    <?php
                                    $path = 'uploads/' . $best["id_kos"] . '/foto_depan.jpg';
                                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/' . $path;
                                    if (file_exists($absolutePath)) {
                                    ?>
                                        <img src="<?= asset($path) ?>" class="card-img-top" alt="Kost Image">
                                    <?php
                                    } else {

                                    ?>
                                        <img src="<?= asset(path: 'default/default.jpg') ?>" class="card-img-top" alt="No Image Available">
                                    <?php
                                    }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $best['nama_kos'] ?></h5>
                                        <span class="btn-available"
                                            style="border-radius: 4px;"><?php echo $best['tipe_kos'] ?></span>
                                        <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                            <?php echo $best['alamat'] ?></p>
                                        <p class="card-text" style="font-weight: 600;"><?php echo $best['avg_rating'] ?>/5
                                            (<?php echo $best['review_count'] ?>)</p>
                                        <span class="btn-available"
                                            style="border-radius: 4px;"><?php echo $best['tipe_kos'] ?></span>
                                        <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                            IDR
                                            <?php
                                            $arr = $best['waktu_penyewaan'];
                                            $array = explode(',', $arr);
                                            $array = array_reverse($array);

                                            foreach ($array as $value) {
                                                switch ($value) {
                                                    case 'Bulanan':
                                                        echo $best['harga'];
                                                        break 2;
                                                    case 'Harian':
                                                        echo $best['harga_hari'];
                                                        break 2;
                                                    case 'Mingguan':
                                                        echo $best['harga_minggu'];
                                                        break 2;
                                                    default:
                                                        echo $best['harga'];
                                                        break;
                                                }
                                            }
                                            ?>
                                            <span
                                                style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                                <?php
                                                $arr = $best['waktu_penyewaan'];
                                                $array = explode(',', $arr);
                                                $array = array_reverse($array);

                                                foreach ($array as $value) {
                                                    switch ($value) {
                                                        case 'Bulanan':
                                                            echo "Bulanan";
                                                            break 2;
                                                        case 'Mingguan':
                                                            echo "Mingguan";
                                                            break 2;
                                                        case 'Harian':
                                                            echo "Harian";
                                                            break 2;
                                                        default:
                                                            echo "Bulanan";
                                                            break;
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </p>
                                        <a class="btn-order" href="#">Pesan sekarang</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    </body>