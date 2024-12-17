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
            background-color: #f3f2ff;
        }

        .card {
            width: 80%;
            height: auto;
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
                </div>
            </div>
            </div>
            <div class="container-fluid">
                <div class="row" style="margin-top: 32px;">
                    <?php foreach ($data['best'] as $best): ?>
                        <div class="col-md-3 p-3 mb-4">
                            <a href="<?= BASEURL . 'detailkos/' . $best["id_kos"] ?>" class="card-link">
                                <div class="card">
                                    <?php
                                    $path = $best["id_kos"] . '/foto_depan.jpg';
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