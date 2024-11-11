<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    body {
        background-color: #F3F2FF;
    }

    .card {
        border: 1px solid #d3d3d3;
    }

    .card-header {
        background-color: #e5e4ff;
        border: 1px solid #d3d3d3;
    }

    .btn-prev {
        background-color: #6c757d;
        color: #FFFFFF;
    }

    .btn-next {
        background-color: #303030;
        color: #FFFFFF;
    }

    .step-container {
        display: none;
    }

    .step-container.active {
        display: block;
    }

    .progress-bar-container {
        margin: 20px 0;
        padding: 0 50px;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }

    .progress-steps::before {
        content: "";
        background-color: #e0e0e0;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        z-index: 1;
    }

    .progress-step-item {
        background-color: #ffffff;
        border: 3px solid #e0e0e0;
        border-radius: 50%;
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .progress-step-item.active {
        background-color: #303030;
        border-color: #303030;
        color: white;
    }

    .progress-step-item.completed {
        background-color: #4a4af3;
        border-color: ##4a4af3;
        color: white;
    }

    .photo-box {
        width: 400px;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px;
        background-color: #fff;
        position: relative;
    }

    .photo-box i {
        font-size: 24px;
        color: #ccc;
    }

    .photo-box p {
        margin: 0;
        font-size: 14px;
        color: #ccc;
        position: absolute;
        bottom: 10px;
    }
</style>

<div class="container mt-5">
    <div class="progress-bar-container">
        <div class="progress-steps">
            <div class="progress-step-item active" data-step="1">1</div>
            <div class="progress-step-item" data-step="2">2</div>
            <div class="progress-step-item" data-step="3">3</div>
            <div class="progress-step-item" data-step="4">4</div>
        </div>
    </div>

    <!-- Form Utama -->
    <form id="multiStepForm" action="<?= BASEURL; ?>datakos/tambah" method="post" onsubmit="handleSubmit(event)">
        <div class="card mb-4">
            <div class="step-container active" data-step="1">
                <h5 class="card-header">Data Kos</h5>
                <div class="card-body">
                    <div class="row m-5">
                        <div class="mb-3 row">
                            <label for="namakos" class="col-sm-2 col-form-label">Nama Kos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kos" id="namakos"
                                    placeholder="Masukan Nama Kos">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jumlahkamar" class="col-sm-2 col-form-label">Jumlah Kamar</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nama_kos" id="jumlahkamar"
                                    placeholder="Masukkan Jumlah Kamar">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tipekos" class="col-sm-2 col-form-label">Disewakan Untuk</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tipekos" type="radio" name="tipekos"
                                        id="putra" value="Putra">
                                    <label class="form-check-label" for="putra">Putra</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipekos" id="putri"
                                        value="Putri">
                                    <label class="form-check-label" for="putri">Putri</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipekos" id="campur"
                                        value="Campur">
                                    <label class="form-check-label" for="campur">Campur</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsikos" class="col-sm-2 col-form-label">Deskripsi Kos</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="deskripsi" id="deskripsikos"
                                    placeholder="Tuliskan deskripsi kos anda..." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="peraturankos" name="peraturan" class="col-sm-2 col-form-label">Peraturan
                                Kos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="peraturankos"
                                    placeholder="Tentukan aturan kos disini...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 2: Fasilitas Kos -->
            <div class="step-container" data-step="2">
                <h5 class="card-header">Fasilitas Kamar</h5>
                <div class="card-body">
                    <div class="row m-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5 mb-3">Fasilitas Kamar</label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kasur">
                                        <label class="form-check-label" for="kasur">
                                            Kasur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ac">
                                        <label class="form-check-label" for="ac">
                                            AC
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kipas_angin">
                                        <label class="form-check-label" for="kipas_angin">
                                            Kipas Angin
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lemari">
                                        <label class="form-check-label" for="lemari">
                                            Lemari
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="meja">
                                        <label class="form-check-label" for="meja">
                                            Meja
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kamar_mandi_dalam">
                                        <label class="form-check-label" for="kamar_mandi_dalam">
                                            Kamar Mandi Dalam
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="air_hangat">
                                        <label class="form-check-label" for="air_hangat">
                                            Air Hangat
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Alamat Kos -->
            <div class="step-container" data-step="3">
                <h5 class="card-header">Cari Alamat Kos</h5>
                <div class="card-body">
                    <div class="container mt-3 mb-5">
                        <div id="map" style="height: 400px; width: 100%;" class="mb-3"></div>
                        <button type="button" class="btn btn-primary mb-3" onclick="getCurrentLocation()">
                            <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
                        </button>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat akan terisi otomatis ketika memilih lokasi di peta" rows="3"
                                style="resize: none;" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    <div class="text-end mx-5">
                    </div>
                </div>
            </div>
        </div>
        <!-- Step 4: Foto Kos -->
        <div class="step-container" data-step="4">
            <h5 class="card-header">
                Pasang Foto Kos
                <div class="tips">
                    <div>
                        <i class="fas fa-info-circle"></i>
                        Tips upload foto
                    </div>
                    <a href="#">Lihat tips</a>
                </div>
            </h5>
            <div class="card-body">
                <div class="row m-5">
                    <div class="col-md-6 mb-4">
                        <h2 class="font-semibold mb-2">Foto bangunan depan</h2>
                        <p class="text-sm text-gray-500 mb-4">Foto horizontal akan terlihat lebih bagus sebagai foto
                            utama kos.</p>
                        <label for="foto-depan" class="photo-box">
                            <input type="file" accept="image/*" id="foto-depan" name="foto_depan"
                                style="display: none;">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan depan</p>
                        </label>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h2 class="font-semibold mb-2">Foto bangunan dari belakang</h2>
                        <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan kos dari belakang ke calon penyewa.
                        </p>
                        <label for="foto-belakang" class="photo-box">
                            <input type="file" accept="image/*" name="foto_belakang" id="foto-belakang"
                                style="display: none;">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan dari belakang</p>
                        </label>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h2 class="font-semibold mb-2">Foto bangunan dalam</h2>
                        <p class="text-sm text-gray-500 mb-4">Perlihatkan suasana di dalam dengan cahaya terang agar
                            terlihat lebih jelas</p>
                        <label for="foto-dalam" class="photo-box">
                            <input type="file" accept="image/*" name="foto_dalam" id="foto-dalam"
                                style="display: none;">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto dalam bangunan</p>
                        </label>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h2 class="font-semibold mb-2">Foto bangunan dari jalan</h2>
                        <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan sekitar depan kos ke calon penyewa.
                        </p>
                        <label for="foto-jalan" class="photo-box">
                            <input type="file" accept="image/*" name="foto_jalan" id="foto-jalan"
                                style="display: none;">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan dari jalan</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-between mt-3 mb-5">
            <button type="button" class="btn btn-prev" onclick="prevStep()">
                <i class="fas fa-chevron-left me-2"></i>Sebelumnya
            </button>
            <button type="button" class="btn btn-next" onclick="nextStep()">
                Selanjutnya<i class="fas fa-chevron-right ms-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 4;

    function updateProgressBar() {
        document.querySelectorAll('.progress-step-item').forEach(item => {
            const step = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (step === currentStep) {
                item.classList.add('active');
            } else if (step < currentStep) {
                item.classList.add('completed');
            }
        });
    }

    function showStep(step) {
        document.querySelectorAll('.step-container').forEach(container => {
            container.classList.remove('active');
        });
        document.querySelector(`.step-container[data-step="${step}"]`).classList.add('active');

        const prevBtn = document.querySelector('.btn-prev');
        const nextBtn = document.querySelector('.btn-next');

        if (step === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
        }

        if (step === totalSteps) {
            nextBtn.innerHTML = 'Selesai<i class="fas fa-check ms-2"></i>';
        } else {
            nextBtn.innerHTML = 'Selanjutnya<i class="fas fa-chevron-right ms-2"></i>';
        }
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
            updateProgressBar();
        } else {
            submitForm();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            updateProgressBar();
        }
    }

    function goToStep(step) {
        currentStep = step;
        showStep(currentStep);
        updateProgressBar();
    }

    function setUkuran(value) {
        var customInput = document.getElementById('UkuranCustom');
        if (value === "custom") {
            customInput.style.display = 'block';
            customInput.focus();
        } else {
            customInput.style.display = 'none';
            customInput.value = value;
        }
    }

    function formatInput(input) {
        let value = input.value.replace(/[^0-9x]/g, '');
        let parts = value.split('x');
        if (parts.length > 2) {
            parts = [parts[0], parts.slice(1).join('')];
        }
        if (parts.length === 2 && parts[1] !== '') {
            input.value = `${parts[0]}x${parts[1]} m`;
        } else {
            input.value = value;
        }
    }

    // Peta
    var map = L.map('map').setView([-2.5489, 118.0149], 5);
    var marker;

    // Layer peta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan pencarian
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
    }).addTo(map);

    // Mendapatkan lokasi pengguna
    function getCurrentLocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Hapus marker sebelumnya 
                if (marker) {
                    map.removeLayer(marker);
                }

                // Untuk Marker
                marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);

                // Set view ke lokasi pengguna
                map.setView([latitude, longitude], 16);

                // Update form koordinat
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                // Dapatkan alamat dari koordinat
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('alamat').value = data.display_name;
                    });

                marker.on('dragend', updateMarkerPosition);
            }, function (error) {
                // Handle error
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Izin menggunakan lokasi ditolak. Mohon aktifkan akses lokasi di browser Anda.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Informasi lokasi tidak tersedia.");
                        break;
                    case error.TIMEOUT:
                        alert("Waktu permintaan lokasi habis.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("Terjadi kesalahan yang tidak diketahui.");
                        break;
                }
            });
        } else {
            alert("Browser Anda tidak mendukung geolokasi.");
        }
    }

    function updateMarkerPosition(event) {
        var position = marker.getLatLng();
        // Update koordinat
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;

        // Reverse geocoding untuk mendapatkan alamat
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.lat}&lon=${position.lng}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('alamat').value = data.display_name;
            });
    }

    // Event handler untuk hasil pencarian
    geocoder.on('markgeocode', function (e) {
        var location = e.geocode.center;
        var address = e.geocode.name;

        // Hapus marker sebelumnya jika ada
        if (marker) {
            map.removeLayer(marker);
        }

        // Tambah marker baru
        marker = L.marker(location, { draggable: true }).addTo(map);

        // Set view ke lokasi yang dipilih
        map.setView(location, 16);

        // Update form
        document.getElementById('alamat').value = address;
        document.getElementById('latitude').value = location.lat;
        document.getElementById('longitude').value = location.lng;

        // Event saat marker di-drag
        marker.on('dragend', updateMarkerPosition);
    });

    document.addEventListener('DOMContentLoaded', getCurrentLocation);

    function submitForm() {
        const form = document.getElementById('multiStepForm');
        const formData = new FormData(form);

        function submitForm() {
            const form = document.getElementById('multiStepForm');
            const formData = new FormData(form);

            // Collect checked fasilitas
            const fasilitas = [];
            document.querySelectorAll('input[name="fasilitas[]"]:checked').forEach(checkbox => {
                fasilitas.push(checkbox.value);
            });
            formData.append('fasilitas', JSON.stringify(fasilitas));

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data kos berhasil disimpan',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = BASEURL + 'datakos/fasilitas';
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data',
                        icon: 'error'
                    });
                });
        }

        const fasilitas = [];
        document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
            fasilitas.push(checkbox.id);
        });
        formData.append('fasilitas[]', fasilitas);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data kos berhasil disimpan',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = BASEURL + 'datakos';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
        showStep(currentStep);
        updateProgressBar();
    });


</script>