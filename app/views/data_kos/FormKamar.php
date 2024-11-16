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
        border-color: #4a4af3;
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
    <form id="multiStepForm" action="<?= BASEURL; ?>fasilitaskos/tambah" method="post" onsubmit="handleSubmit(event)">
        <div class="card mb-4">
            <div class="step-container" data-step="2">
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
                            <p class="text-sm text-gray-500 mb-4">Foto depan kamar dari pintu dengan cahaya yang terang.
                            </p>
                            <label for="foto-depan-kamar" class="photo-box">
                                <input type="file" accept="image/*" id="foto-depan-kamar" style="display: none;">
                                <i class="fas fa-camera"></i>
                                <p class="text-gray-400">Tambah foto kamar dari depan</p>
                            </label>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h2 class="font-semibold mb-2">Foto kamar mandi</h2>
                            <p class="text-sm text-gray-500 mb-4">Tunjukkan foto kamar mandi yang akan digunakan oleh
                                penyewa.</p>
                            <label for="foto-kamar-mandi" class="photo-box">
                                <input type="file" accept="image/*" id="foto-kamar-mandi" style="display: none;">
                                <i class="fas fa-camera"></i>
                                <p class="text-gray-400">Tambah foto kamar mandi</p>
                            </label>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h2 class="font-semibold mb-2">Foto dalam kamar</h2>
                            <p class="text-sm text-gray-500 mb-4">Foto bagian dalam kamar secara jelas untuk calon
                                penyewa.
                            </p>
                            <label for="foto-dalam-kamar" class="photo-box">
                                <input type="file" accept="image/*" id="foto-dalam-kamar" style="display: none;">
                                <i class="fas fa-camera"></i>
                                <p class="text-gray-400">Tambah foto dalam kamar</p>
                            </label>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h2 class="font-semibold mb-2">Tambah foto lain?</h2>
                            <p class="text-sm text-gray-500 mb-4">Tambah foto fasilitas umum kos disini.(opsional).</p>
                            <label for="foto-lain" class="photo-box">
                                <input type="file" accept="image/*" id="foto-lain" style="display: none;">
                                <i class="fas fa-camera"></i>
                                <p class="text-gray-400">Tambah foto lain berupa opsional</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- //Step 2: Spesifikasi Kamar  -->
            <div class="step-container" data-step="1">
                <h5 class="card-header">Spesifikasi Kamar</h5>
                <div class="card-body">
                    <div class="row m-5">
                        <div class="mb-3 row">
                            <label for="TipeKamar" class="col-sm-2 col-form-label">Tipe Kamar</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Tipe_Kamar" name="tipe_kamar">
                                    <option value="">Pilih tipe kamar</option>
                                    <option value="A">Tipe A</option>
                                    <option value="B">Tipe B</option>
                                    <option value="C">Tipe C</option>
                                    <option value="D">Tipe D</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Ukuran" class="col-sm-2 col-form-label">Ukuran Kamar</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="UkuranSelect" name="luas_kamar">
                                    <option value="">Pilih ukuran</option>
                                    <option value="2x2">2x2 m</option>
                                    <option value="2x3">2x3 m</option>
                                    <option value="3x3">3x3 m</option>
                                    <option value="3x4">3x4 m</option>
                                    <option value="4x4">4x4 m</option>
                                    <option value="4x5">4x5 m</option>
                                    <option value="5x5">5x5 m</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="totalkamar" class="col-sm-2 col-form-label">Total Kamar</label>
                            <div class="col-sm-10">
                                <input type="number" name="total_kamar" class="form-control" id="totalkamar"
                                    placeholder="Masukkan total kamar...">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kamartersedia" class="col-sm-2 col-form-label">Jumlah Kamar Tersedia</label>
                            <div class="col-sm-10">
                                <input type="number" name="kamar_tersedia" class="form-control" id="kamartersedia"
                                    placeholder="Masukkan jumlah ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- //Step 4: Harga  -->
            <div class="step-container" data-step="4">
                <h5 class="card-header">Harga</h5>
                <div class="card-body">
                    <div class="row m-5">
                    </div>
                    <div class="mb-3 row">
                        <label for="perhari" class="col-sm-2 col-form-label">Harga Per Hari</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga_hari" id="harga_minggu" class="form-control"
                                placeholder="Rp.0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="perminggu" class="col-sm-2 col-form-label">Harga Per Minggu</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga_minggu" id="harga_minggu" class="form-control"
                                placeholder="Rp.0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="perbulan" class="col-sm-2 col-form-label">Harga Per Bulan</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga_bulan" id="harga_bulan" class="form-control"
                                placeholder="Rp.0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- //Step 3: Tambahan  -->
            <div class="step-container" data-step="3">
                <h5 class="card-header">Fasilitas Kos</h5>
                <div class="card-body">
                    <div class="row m-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold fs-5 mb-3">Fasilitas Kamar</label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Kasur"
                                            id="Kasur">
                                        <label class="form-check-label" for="Kasur">
                                            Kasur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Kipas_Angin" id="Kipas_Angin">
                                        <label class="form-check-label" for="Kipas_Angin">
                                            Kipas Angin
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="AC"
                                            id="AC">
                                        <label class="form-check-label" for="AC">
                                            AC
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Meja"
                                            id="Meja">
                                        <label class="form-check-label" for="Meja">
                                            Meja
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Lemari" id="Lemari">
                                        <label class="form-check-label" for="Lemari">
                                            Lemari
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Kamar_Mandi_Dalam" id="Kamar_Mandi_Dalam">
                                        <label class="form-check-label" for="Kamar_Mandi_Dalam">
                                            Kamar Mandi Dalam
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Air_Hangat" id="Air_Hangat">
                                        <label class="form-check-label" for="Air_Hangat">
                                            Air Hangat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas[]"
                                            value="Bantal" id="Bantal">
                                        <label class="form-check-label" for="Bantal">
                                            Bantal
                                        </label>
                                    </div>
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

    function submitForm() {
        const form = document.getElementById('multiStepForm');
        const formData = new FormData(form);

        // Collect checked fasilitas
        const fasilitas = [];
        document.querySelectorAll('input[name="fasilitas[]"]:checked').forEach(checkbox => {
            fasilitas.push(checkbox.value);
        });

        // Tambahkan fasilitas yang dicentang ke formData
        formData.append('fasilitas', (fasilitas));

        // Kirim data menggunakan fetch
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data.success) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data kos berhasil disimpan',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = BASEURL + 'datakos/';
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
                console.log(error);

                console.error('Error:', error);
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data kos berhasil disimpan',
                    icon: 'success'
                });
            });
    }


    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
        showStep(currentStep);
        updateProgressBar();
    });

</script>