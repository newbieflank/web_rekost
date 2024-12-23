   <link rel="stylesheet" href="<?= asset('css/popular.css') ?>">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <style>
       html {
           scroll-behavior: smooth;
       }

       body {
           padding-top: 0;
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

   <section class="populer">
       <div class="container-fluid px-4">
           <div class="row">
               <div class="col-md-0 p-4">
                   <h2 style="font-size: 32px; font-weight: bold; margin-top: 24px">
                       <img src="<?= asset('img/icon.png') ?>" alt="Icon"
                           style="margin-right: 16px; margin-top: -4px;">Check what's popular in Re-kost!
                   </h2>
                   <p style="font-size: 16px; font-weight: normal; color: #5F5F5F">Temukan kost terpopuler dengan
                       fasilitas terbaik dan lokasi strategis hanya di Re-Kost.</p>
               </div>
           </div>
           <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
               <div class="mb-3 mb-md-0 position-relative">
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
               <?php foreach ($data['popular'] as $popular): ?>
                   <div class="col-md-3 mb-4">
                       <a href="<?= BASEURL . 'detailkos/' . $popular["id_kos"] ?>" class="card-link">
                           <div class="card">
                               <?php
                                $path = $popular["id_kos"] . '/foto_depan.jpg';
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
                                   <h5 class="card-title" style="font-size: 20px; font-weight: bold;">
                                       <?php echo $popular['nama_kos'] ?>
                                   </h5>
                                   <span class="btn-available mb-3" style="border-radius: 4px;">
                                       <?php echo $popular['tipe_kos'] ?></span>
                                   <p class="card-text mt-3" style="font-size: 14px;"><i class="fas fa-map-marker-alt"></i>
                                       <?php echo $popular['alamat'] ?>
                                   </p>

                                   <p class="card-text" style="font-weight: 600;"><?php echo $popular['avg_rating'] ?>/5
                                       (<?php echo $popular['review_count'] ?>)</p>
                                   <p class="card-text" style="font-size: 20px; font-weight: bold; color: #E52424;">
                                       IDR
                                       <?php
                                        $arr = $popular['waktu_penyewaan'];
                                        $array = explode(',', $arr);
                                        $array = array_reverse($array);

                                        foreach ($array as $value) {
                                            switch ($value) {
                                                case 'Bulanan':
                                                    echo number_format($popular['harga'], 0, ',', '.');
                                                    break 2;
                                                case 'Harian':
                                                    echo number_format($popular['harga_hari'], 0, ',', '.');
                                                    break 2;
                                                case 'Mingguan':
                                                    echo number_format($popular['harga_minggu'], 0, ',', '.');
                                                    break 2;
                                                default:
                                                    echo number_format($popular['harga'], 0, ',', '.');
                                                    break;
                                            }
                                        }
                                        ?>
                                       <span
                                           style="font-size: 16px; font-weight: normal; color:#4A4A4A">/
                                           <?php
                                            $arr = $popular['waktu_penyewaan'];
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
                                   <a class="btn-order" href="<?= BASEURL . 'detailkos/' . $popular["id_kos"] . '/konfirmasi' ?>">Pesan sekarang</a>
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
   <script src="<?= asset('js/popular.js') ?>"></script>
   </body>