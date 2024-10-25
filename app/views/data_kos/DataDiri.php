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

    .btn-lewati {
        background-color: #f8f9fa;
        color: #000000;
        border: 1px solid #d3d3d3;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .info {
        display: flex;
        align-items: center;
        margin-top: 10px;
        margin-left: 10px;
        border: 1px solid #d3d3d3;
        padding: 15px;
        border-radius: 5px;
        width: 1120px;
    }

    .info i {
        color: #007bff;
        margin-right: 5px;
    }
</style>

<!-- Form Data Diri Kos -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Lengkapi Data Data Diri Anda</h5>
        <div class="card-body">
            <form id="myForm" class="row m-5 custom-form" method="post" action="update">
                <div class="mb-3 row">
                <h6>Silakan isi data berikut ini untuk mulai mengaktifkan fitur Booking Langsung.</h6>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nomorrekening" class="col-sm-2 col-form-label">Nomor Rekening</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nomorrekening"
                            placeholder="Masukkan Nomor Rekening">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="namabank" class="col-sm-2 col-form-label">Nama Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namabank" placeholder="Masukkan Nama Bank">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pemilikrekening" class="col-sm-2 col-form-label">Nama Pemilik Rekening</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pemilikrekening" placeholder="pemilikrekening">
                    </div>
                </div>
                <div class="info">
                    <i class="fas fa-info-circle"></i>
                    <span>
                        Pastikan data Anda benar dan sesuai, agar uang pembayaran kos dapat ditransfer dengan lancar.
                    </span>
                </div>


            </form>
        </div>
    </div>
    <div class="form-actions">
        <div class="text-end">
            <a href="popular">
                <button type="submit" form="myForm" class="btn btn-lewati">Lewati<i
                        class="fas fa-chevron-right ms-2"></i></button>
            </a>
        </div>
        <div class="text-end">
            <a href="popular">
                <button type="submit" form="myForm" class="btn btn-lanjut">Lanjutkan<i
                        class="fas fa-chevron-right ms-2"></i></button>
            </a>
        </div>
    </div>
</div>