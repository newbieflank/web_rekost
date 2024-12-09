   <link rel="stylesheet" href="<?= asset('css/popular.css') ?>">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
       integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMR0O4v8rZ7tH6XGm7q4cdw8dF/6g2IsG2M5eR" crossorigin="anonymous">
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
               <div class="mb-3 mb-md-0">
                   <div class="dropdown d-inline-block mr-3">
                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownLokasi"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-map-marker-alt"></i> Lokasi
                       </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownLokasi">
                           <a class="dropdown-item" href="Blindungan">Blindungan</a>
                           <a class="dropdown-item" href="Tamanan">Tamanan</a>
                           <a class="dropdown-item" href="Tamansari">Tamansari</a>
                           <a class="dropdown-item" href="Tapen">Tapen</a>
                           <a class="dropdown-item" href="Sempol">Sempol</a>
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
               <?php foreach ($data['popular'] as $popular): ?>
                   <div class="col-md-3 mb-4">
                       <a href="<?= BASEURL . 'detailkos/' . $popular["id_kos"] ?>" class="card-link">
                           <div class="card">
                               <img src="<?= asset('uploads/' . $popular["id_kos"] . '/foto_depan.jpg') ?>"
                                   class="card-img-top" alt="Kost Image">
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
                                                    echo $popular['harga'];
                                                    break 2;
                                                case 'Harian':
                                                    echo $popular['harga_hari'];
                                                    break 2;
                                                case 'Mingguan':
                                                    echo $popular['harga_minggu'];
                                                    break 2;
                                                default:
                                                    echo $popular['harga'];
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