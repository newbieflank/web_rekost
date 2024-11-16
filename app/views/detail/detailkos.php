<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Re-Kost
    </title>
    <link rel="stylesheet" href="<?= asset('css/detailkos.css') ?>">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <style>
        html {
            scroll-behavior: smooth;
        }

        #info,
        #fasilitas,
        #lokasi,
        #kebijakan,
        #tentang {
            scroll-margin-top: 80px;
        }

        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".nav-tabs" data-bs-offset="80" tabindex="0">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <a class="navbar-brand" href="#">
                <img src="<?= asset('img/logo.png') ?>" alt="Re-Kost Logo" height="50">
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#bookings">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <img src="<?= asset('img/user.png') ?>" alt="profile">
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="foto mt-4">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-7 p-2">
                    <img src="<?= asset('img/home1.png') ?>" alt="thumbnail" class="thumbnail w-100">
                </div>
                <div class="col-md-5 d-flex flex-wrap justify-content-around">
                    <div class="row">
                        <img src="<?= asset('img/home2.png') ?>" alt="thumbnail" class="img-fluid w-50 p-2">
                        <img src="<?= asset('img/home3.png') ?>" alt="thumbnail" class="img-fluid w-50 p-2">
                        <img src="<?= asset('img/home4.png') ?>" alt="thumbnail" class="img-fluid w-50 p-2">
                        <img src="<?= asset('img/home5.png') ?>" alt="thumbnail" class="img-fluid w-50 p-2">
                    </div>
                </div>
            </div>
        </div>
        <div class="info">
            <div class="container-fluid px-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#info-content">Info Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kebijakan">Kebijakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between info-content" id="info-content">
                    <div class="left-section">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h1>Kos Putri Muslimah</h1>
                        <span>4.5/5 | 100 Reviews</span>
                    </div>
                    <div class="price">
                        <span class="text-grey">Mulai dari</span> <br>
                        <span class="text-red">IDR 500.000</span> <br>
                        <span class="text-grey">/kamar/bulan</span>
                        <a href="2147483647/konfirmasi" class="btn btn-primary w-100" style="margin-top: 10px;">Ajukan Sewa</a>
                    </div>
                </div>
            </div>
            <div class="px-4">
                <hr>
            </div>
            <div class="fasilitas col-md-6 px-4" id="fasilitas">
                <h3>
                    Fasilitas Populer
                </h3>
                <div class="icons">
                    <div><i class="fas fa-wifi"></i>Wifi</div>
                    <div><i class="fas fa-utensils"> </i> Dapur</div>
                    <div> <i class="fas fa-clock"> </i> 24 Jam</div>
                    <div> <i class="fas fa-fan"> </i> AC/Kipas Angin</div>
                    <div> <i class="fas fa-table"> </i> Meja</div>
                    <div> <i class="fas fa-car"> </i> Parkir</div>
                    <div> <i class="fas fa-archive"> </i> Lemari</div>
                    <div> <i class="fas fa-calendar-alt"> </i> Mingguan/Bulanan</div>
                    <div> <i class="fas fa-tv"> </i> Televisi</div>
                </div>
            </div>
            <div class="px-4">
                <hr>
            </div>
            <div class="fasilitas col-md-6 px-4">
                <h3>
                    Fasilitas Lainnya
                </h3>
                <div class="icons">
                    <div> <i class="fas fa-praying-hands"></i> Musholla</div>
                    <div><i class="fas fa-shopping-cart"></i> Supermarket</div>
                    <div><i class="fas fa-university"></i> ATM/Bank</div>
                    <div><i class="fas fa-tshirt"></i> Laundry</div>
                    <div><i class="fas fa-prescription-bottle-alt"></i> Apotek</div>
                    <div> <i class="fas fa-praying-hands"></i> Musholla</div>
                    <div><i class="fas fa-shopping-cart"></i> Supermarket</div>
                    <div><i class="fas fa-university"></i> ATM/Bank</div>
                    <div><i class="fas fa-tshirt"></i> Laundry</div>
                    <div><i class="fas fa-prescription-bottle-alt"></i> Apotek</div>
                </div>
                <span class="toggle-btn" onclick="toggleFasilitas()">Lihat lebih banyak <i class="fas fa-chevron-down"></i></span>
            </div>
        </div>
        <div class="px-4">
            <hr>
        </div>
        <div class="location container-fluid px-4" id="lokasi">
            <h3 style="margin-bottom: 24px;">Lokasi</h3>
            <div class="location-content">
                <div class="map-container">
                    <div id="map"></div>
                </div>
                <div class="address" style="margin-top: 24px; font-size: 18px">
                    Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121.
                </div>
            </div>
        </div>
        <div class="px-4">
            <hr>
        </div>
        <div class="kebijakan container-fluid px-4" id="kebijakan">
            <div class="row">
                <h3>Kebijakan</h3>
                <div class="col-md-4">
                    <h6>Yang Harus Diketahui</h6>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <h6>Hewan Peliharaan</h6>
                        <p>Hewan Peliharaan Tidak Diperbolehkan.</p>
                    </div>
                    <div class="row">
                        <h6>Tamu</h6>
                        <p>Tidak diperbolehkan membawa lawan jenis masuk ke dalam kos/kamar.</p>
                    </div>
                    <div class="row">
                        <h6>Deposit</h6>
                        <p>Teman menginap dikenakan biaya.</p>
                    </div>
                    <div class="row">
                        <h6>Alkohol</h6>
                        <p>Tidak diperbolehkan membawa minuman keras atau obat-obatan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4">
            <hr>
        </div>
        <div class="about" id="about">
            <h3>Tentang Kos Putri Muslimah Blindungan</h3>
            <p>
                Kos Putri Muslimah berlokasi di Blindungan, Bondowoso yang dapat kalian temukan di aplikasi maupun website Re-Kost.
            </p>
            <p>
                Kamar ber-AC yang dilengkapi dengan meja belajar, TV, lemari dan kasur yang nyaman. Kamar mandi dalam yang bersih dan dilengkapi dengan berbagai fasilitas lain yang dapat kalian dapatkan di Kos Putri Muslim Blindungan.
            </p>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="chats" class="btn btn-primary btn-lg w-50 mb-4 text-center">
                Tanya Pemilik Sebelum Sewa
            </a>
        </div>

    </section>
    <script crossorigin="anonymous" integrity="sha384-oBqDVmMz4fnFO9gybBogGz1p6QF1bM4Jp+7F2m1i6U8zTnm5zT9UJ0Zr+2QIT3hK" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '.nav-tabs',
            offset: 80
        });
    </script>
    <script>
        function initMap() {
            var map = L.map('map').setView([-8.15946626438085, 113.72347203723199], 13);

            // Menambahkan tile layer dari OpenStreetMap
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Menambahkan pin (marker) pada lokasi tertentu
            var marker = L.marker([-8.15946626438085, 113.72347203723199]).addTo(map);

            // Zoom in ke level yang lebih tinggi
            map.setZoom(16);

            // Tambahkan popup pada marker
            marker.bindPopup("<b>Lokasi Saya</b><br>Ini adalah lokasi yang dipilih.").openPopup();
        }
        initMap()
    </script>
    <script>
        function toggleFasilitas() {
            const fasilitas = document.querySelectorAll('.fasilitas .icons div:nth-child(n + 6)');
            const toggleBtn = document.querySelector('.toggle-btn');
            const toggleIcon = toggleBtn.querySelector('i');

            // Jika semua item terlihat, sembunyikan beberapa
            if (toggleBtn.textContent.includes('Lihat lebih sedikit')) {
                fasilitas.forEach((el, index) => {
                    el.style.display = 'none';
                });
                toggleBtn.textContent = 'Lihat lebih banyak';
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
            } else {
                fasilitas.forEach(el => {
                    el.style.display = 'block';
                });
                toggleBtn.textContent = 'Lihat lebih sedikit';
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        }
    </script>
</body>

</html>