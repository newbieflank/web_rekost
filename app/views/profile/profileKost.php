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
</style>

<!-- Form Profile -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Informasi Pribadi</h5>
        <div class="card-body">
            <div class="container mt-3 mb-5">
                <div class="imgProfile d-block mx-auto">
                    <img src="<?= BASEURL; ?>img/img1.png" class="rounded-circle d-block mx-auto" alt="">
                </div>
            </div>
            <form id="myForm" class="row m-5 custom-form" method="post" action="update">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Masukan Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Masukkan E-mail">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_kos" class="col-sm-2 col-form-label">Nama Kost</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_kos" placeholder="Masukkan Nama Kos">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" id="Lokasi" placeholder="Masukkan Lokasi">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nomorhandphone" class="col-sm-2 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control mb-3" id="nomorhandphone" placeholder="Masukan Nomor Handphone">
                        <input type="number" class="form-control" id="nomorhandphone" placeholder="Masukan Nomor Handphone">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="text-end mx-5">
        <a href="popular">
            <button type="submit" form="myForm" class="btn btn-lanjut">Lanjutkan<i
                    class="fas fa-chevron-right ms-2"></i></button>
        </a>
    </div>
</div>