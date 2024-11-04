
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    
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
                <div class="progress-step-item" data-step="5">5</div>
                <div class="progress-step-item" data-step="6">6</div>
                <div class="progress-step-item" data-step="7">7</div>
                <div class="progress-step-item" data-step="8">8</div>
            </div>
        </div>

        <!-- Form Utama -->
        <form id="multiStepForm">
            <div class="card mb-4">
                <div class="step-container active" data-step="1">
                    <h5 class="card-header">Data Kos</h5>
                    <div class="card-body">
                        <div class="row m-5">
                            <div class="mb-3 row">
                                <label for="namakos" class="col-sm-2 col-form-label">Nama Kos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namakos" placeholder="Masukan Nama Kos">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumlahkamar" class="col-sm-2 col-form-label">Jumlah Kamar</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlahkamar" placeholder="Masukkan Jumlah Kamar">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tipekos" class="col-sm-2 col-form-label">Disewakan Untuk</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipekos" id="putra" value="Putra">
                                        <label class="form-check-label" for="putra">Putra</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipekos" id="putri" value="Putri">
                                        <label class="form-check-label" for="putri">Putri</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipekos" id="campur" value="Campur">
                                        <label class="form-check-label" for="campur">Campur</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsikos" class="col-sm-2 col-form-label">Deskripsi Kos</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="deskripsikos" placeholder="Tuliskan deskripsi kos anda..." rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="peraturankos" class="col-sm-2 col-form-label">Peraturan Kos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="peraturankos" placeholder="Tentukan aturan kos disini...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="catatan" class="col-sm-2 col-form-label">Catatan Lainnya (Opsional)</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="catatan" placeholder="Masukan catatan lainnya disini..." rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 2: Fasilitas Kos -->
                <div class="step-container" data-step="2">
                    <h5 class="card-header">Fasilitas Kos</h5>
                    <div class="card-body">
                        <div class="row m-5">
                            <div class="mb-3 row">
                                <label for="fasilitasumum" class="col-sm-2 col-form-label">Fasilitas Umum</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fasilitasumum" placeholder="Masukkan fasilitas umum...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fasilitaskamar" class="col-sm-2 col-form-label">Fasilitas Kamar</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fasilitaskamar" placeholder="Masukkan fasilitas kamar...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kamarpribadi" class="col-sm-2 col-form-label">Fasilitas Kamar Mandi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kamarpribadi" placeholder="Masukkan fasilitas kamar mandi...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="parkir" class="col-sm-2 col-form-label">Fasilitas Parkir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="parkir" placeholder="Masukkan fasilitas parkir...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="luar" class="col-sm-2 col-form-label">Fasilitas Luar</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="luar" placeholder="Masukkan fasilitas luar kos...">
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
                            <div class="imgMap d-block mx-auto">
                                <img src="/api/placeholder/800/400" alt="Map" class="img-fluid">
                            </div>
                        </div>
                        <div class="row m-5">
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="provinsi" placeholder="Masukkan Provinsi">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Masukkan Kabupaten">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="kecamatan" placeholder="Masukkan Kecamatan" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="catatanalamat" class="col-sm-2 col-form-label">Catatan Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="catatanalamat" placeholder="Masukkan Catatan Alamat">
                                </div>
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
                                <p class="text-sm text-gray-500 mb-4">Foto horizontal akan terlihat lebih bagus sebagai foto utama kos.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto bangunan depan</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Foto bangunan dari belakang</h2>
                                <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan kos dari belakang ke calon penyewa.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto bangunan dari belakang</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Foto bangunan dalam</h2>
                                <p class="text-sm text-gray-500 mb-4">Perlihatkan suasana di dalam dengan cahaya terang agar terlihat lebih jelas</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto dalam bangunan</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Foto bangunan dari jalan</h2>
                                <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan sekitar depan kos ke calon penyewa.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto bangunan dari jalan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Foto Kamar -->
                <div class="step-container" data-step="5">
                    <h5 class="card-header">
                        Pasang Foto Kamar
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
                                <h2 class="font-semibold mb-2">Foto depan kamar</h2>
                                <p class="text-sm text-gray-500 mb-4">Foto depan kamar dari pintu dengan cahaya yang terang.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto kamar dari depan</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Foto kamar mandi</h2>
                                <p class="text-sm text-gray-500 mb-4">Tunjukkan foto kamar mandi yang akan digunakan oleh penyewa.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto kamar mandi</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Foto dalam kamar</h2>
                                <p class="text-sm text-gray-500 mb-4">Foto bagian dalam kamar secara jelas untuk calon penyewa.</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto dalam kamar</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h2 class="font-semibold mb-2">Tambah foto lain?</h2>
                                <p class="text-sm text-gray-500 mb-4">Tambah foto fasilitas umum kos disini.(opsional).</p>
                                <div class="photo-box">
                                    <i class="fas fa-camera"></i>
                                    <p class="text-gray-400">Tambah foto lain berupa opsional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 6: Ketersediaan Kamar -->
                <div class="step-container" data-step="6">
                    <h5 class="card-header">Ketersediaan Kamar</h5>
                    <div class="card-body">
                        <div class="row m-5">
                            <div class="mb-3 row">
                                <label for="Ukuran" class="col-sm-2 col-form-label">Ukuran Kamar</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="UkuranSelect" onchange="setUkuran(this.value)">
                                        <option value="">Pilih ukuran</option>
                                        <option value="3x4">3x4 m</option>
                                        <option value="4x5">4x5 m</option>
                                        <option value="5x6">5x6 m</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                    <input type="text" class="form-control mt-2" id="UkuranCustom" 
                                        placeholder="Contoh: 3x4 m" style="display: none;" 
                                        oninput="formatInput(this)">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="totalkamar" class="col-sm-2 col-form-label">Total Kamar</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="totalkamar" 
                                        placeholder="Masukkan total kamar...">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kamartersedia" class="col-sm-2 col-form-label">Jumlah Kamar Tersedia</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="kamartersedia"
                                        placeholder="Masukkan jumlah ketersediaan kamar">
                                </div>
                            </div>
                            <div class="button mb-3 row">
                                <label for="dataketersediaan" class="col-sm-2 col-form-label">Data Ketersediaan</label>
                                <div class="col-sm-10">
                                    <button class="form-control" id="dataketersediaan" 
                                        onclick="goToStep(7)">Atur Ketersediaan Kamar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 7: Ketersediaan Kamar Detail -->
                <div class="step-container" data-step="7">
                    <h5 class="card-header">
                        <span>Ketersediaan Kamar</span>
                        <div class="filter-buttons">
                            <button class="active">Semua</button>
                            <button>Terisi</button>
                            <button>Kosong</button>
                        </div>
                    </h5>
                    <div class="card-body">
                        <div class="row m-5">
                            <div class="room-grid">
                                <div class="room-card">
                                    <div class="number">1</div>
                                    <h3>Nomor/Nama Kamar</h3>
                                    <input readonly="" type="text" value="1" />
                                    <h3>Fasilitas Kamar</h3>
                                    <input type="text" placeholder="Masukkan fasilitas kamar..." />
                                    <div class="status">
                                        Kamar sudah terisi
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>

                                <div class="room-card">
                                    <div class="number">2</div>
                                    <h3>Nomor/Nama Kamar</h3>
                                    <input type="text" placeholder="2" />
                                    <h3>Fasilitas Kamar</h3>
                                    <input type="text" placeholder="Masukkan fasilitas kamar..." />
                                    <div class="status">
                                        Kamar kosong
                                        <i class="fas fa-circle"></i>
                                    </div>
                                </div>

                                <div class="room-card">
                                    <div class="number">3</div>
                                    <h3>Nomor/Nama Kamar</h3>
                                    <input type="text" placeholder="3" />
                                    <h3>Fasilitas Kamar</h3>
                                    <input type="text" placeholder="Masukkan fasilitas kamar..." />
                                    <div class="status">
                                        Kamar kosong
                                        <i class="fas fa-circle"></i>
                                    </div>
                                </div>

                                <div class="room-card">
                                    <div class="number">4</div>
                                    <h3>Nomor/Nama Kamar</h3>
                                    <input type="text" placeholder="4" />
                                    <h3>Fasilitas Kamar</h3>
                                    <input type="text" placeholder="Masukkan fasilitas kamar..." />
                                    <div class="status">
                                        Kamar kosong
                                        <i class="fas fa-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 8: Harga -->
                <div class="step-container" data-step="8">
                    <h5 class="card-header">Harga</h5>
                    <div class="card-body">
                        <div class="row m-5">
                            <div class="mb-3 row">
                                <label for="pertahun" class="col-sm-2 col-form-label">Harga Per Tahun</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="pertahun" placeholder="Rp.0">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="perbulan" class="col-sm-2 col-form-label">Harga Per Bulan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="perbulan" placeholder="Rp.0">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="perminggu" class="col-sm-2 col-form-label">Harga Per Minggu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="perminggu" placeholder="Rp.0">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="perhari" class="col-sm-2 col-form-label">Harga Per Hari</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="perhari" placeholder="Rp.0">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="biayatambahan" class="col-sm-2 col-form-label">Biaya Tambahan (opsional)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="biayatambahan" placeholder="ex. Listrik.">
                                </div>
                            </div>
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
        const totalSteps = 8;

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
                document.getElementById('multiStepForm').submit();
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

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showStep(currentStep);
            updateProgressBar();
        });
    </script>