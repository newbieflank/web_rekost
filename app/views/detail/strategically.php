    <link rel="stylesheet" href="<?= asset('css/strategically.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            padding-top: 0;
            background-color: #f3f2ff;
        }

        .card {
            width: 350px;
            height: 500px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex-grow: 1;
            padding: 15px;
            overflow: hidden;
        }

        .card-text i {
            color: #000;
        }

        .card-text {
            color: #000;
        }
    </style>

    <body>
        <section class="strategically">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between align-items-start" style="margin-top: 24px; margin-bottom: 24px;">
                        <div>
                            <h2 style="font-size: 32px; font-weight: bold; margin-top: 24px">Strategically Located Kosts Near Campus/Office</h2>
                            <p style="font-size: 16px; font-weight: normal; color: #5F5F5F;">Providing you with quick and convenient boarding house recommendations only at Re-kost.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex overflow-auto">
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Jember</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Bondowoso</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Politeknik Negeri Jember</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Univeristas Muhammadiyah</button>
                        <button type="button" class="btn btn-outline-primary mr-2 d-inline-block">Universitas Islam</button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown d-inline-block mr-3">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownHarga" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-dollar-sign"></i> Harga
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownHarga">
                                <a class="dropdown-item" href="#">Tertinggi ke Terendah</a>
                                <a class="dropdown-item" href="#">Terendah ke Tertinggi</a>
                            </div>
                        </div>
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
                </div>
            </div>
            <div class="container-fluid px-4">
                <div class="row" style="margin-top: 32px;">
                    <?php foreach ($data['campus'] as $campus): ?>
                        <div class="col-md-4 mb-5">
                            <a href="<?= BASEURL . 'detailkos/' . $campus["id_kos"] ?>" class="card-link">
                                <div class="card">
                                    <img src="<?= asset('img/home1.png') ?>" class="card-img-top" height="200" width="300" />
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $campus['nama_kos'] ?></h5>
                                        <span class="btn-available"
                                            style="border-radius: 4px;"><?php echo $campus['tipe_kos'] ?></span>
                                        <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i> <?php echo $campus['alamat'] ?></p>
                                        <p class="card-text" style="font-weight: 600;"><?php echo $campus['avg_rating'] ?>/5 (<?php echo $campus['review_count'] ?>)</p>
                                        <span class="btn-available" style="border-radius: 4px;"><?php echo $campus['status_kamar'] ?></span>
                                        <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                            IDR
                                            <?php
                                            $arr = $campus['waktu_penyewaan'];
                                            $array = explode(',', $arr);
                                            $array = array_reverse($array);

                                            foreach ($array as $value) {
                                                switch ($value) {
                                                    case 'Bulanan':
                                                        echo $campus['harga'];
                                                        break 2;
                                                    case 'Harian':
                                                        echo $campus['harga_hari'];
                                                        break 2;
                                                    case 'Mingguan':
                                                        echo $campus['harga_minggu'];
                                                        break 2;
                                                    default:
                                                        echo $campus['harga'];
                                                        break;
                                                }
                                            }
                                            ?>
                                            <span style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                                <?php
                                                $arr = $campus['waktu_penyewaan'];
                                                $array = explode(',', $arr);
                                                $array = array_reverse($array);

                                                foreach ($array as $value) {
                                                    switch ($value) {
                                                        case 'Bulanan':
                                                            echo "Bulanan";
                                                            break 2;
                                                        case 'Harian':
                                                            echo "Harian";
                                                            break 2;
                                                        case 'Mingguan':
                                                            echo "Mingguan";
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