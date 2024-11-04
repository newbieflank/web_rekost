<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>

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

    .btn-lanjut {
        background-color: #303030;
        color: #FFFFFF;
    }

    .button {
        display: flex;
        justify-content: center;
    }

    .button button {
        background-color: #7a5cf5;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .button button:hover {
        background-color: #6a4ce5;
    }
</style>

<script>
    function setUkuran(value) {
        var customInput = document.getElementById('UkuranCustom');
        if (value === "custom") {
            customInput.style.display = 'block';
            customInput.focus();
        } else {
            customInput.style.display = 'none';
            document.getElementById('UkuranCustom').value = value; // Set nilai dari select ke input jika opsi selain custom
        }
    }
    function setUkuran(value) {
        var customInput = document.getElementById('UkuranCustom');
        if (value === "custom") {
            customInput.style.display = 'block';
            customInput.focus();
        } else {
            customInput.style.display = 'none';
            document.getElementById('UkuranCustom').value = value; // Set nilai dari select ke input jika opsi selain custom
        }
    }

    function formatInput(input) {
        // Menghapus semua karakter yang bukan angka atau 'x'
        let value = input.value.replace(/[^0-9x]/g, '');

        // Memisahkan angka berdasarkan 'x'
        let parts = value.split('x');

        // Memastikan hanya ada dua bagian, jika lebih dari itu gabungkan
        if (parts.length > 2) {
            parts = [parts[0], parts.slice(1).join('')];
        }

        // Jika ada lebih dari satu bagian, tambahkan ' m' di akhir
        if (parts.length === 2 && parts[1] !== '') {
            input.value = `${parts[0]}x${parts[1]} m`;
        } else {
            input.value = value; // Setel nilai sementara
        }
    }
</script>

<!-- Form Ketersediaan Kamar -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Ketersediaan Kamar</h5>
        <div class="card-body">
            <form id="myForm" class="row m-5 custom-form">
                <div class="mb-3 row">
                    <label for="Ukuran" class="col-sm-2 col-form-label">Ukuran Kamar</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="UkuranSelect" onchange="setUkuran(this.value)">
                            <option value="">Pilih ukuran</option>
                            <option value="3x4">3x4 m</option>
                            <option value="4x5">4x5 m</option>
                            <option value="5x6">5x6 m</option>
                            <!-- Opsi lainnya -->
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="UkuranCustom" placeholder="Contoh: 3x4 m"
                            style="display: none;" oninput="formatInput(this)">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="totalkamar" class="col-sm-2 col-form-label">Total Kamar</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="totalkamar" placeholder="Masukkan total kamar...">
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
                        <button class="form-control" id="dataketersediaan">Atur Ketersediaan Kamar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="text-end mx-5">
        <a href="<?= BASEURL; ?>ketersediaanKamar2">
            <button type="button" form="myForm" class="btn btn-lanjut">Lanjutkan<i
                    class="fas fa-chevron-right ms-2"></i></button>
        </a>
    </div>
</div>