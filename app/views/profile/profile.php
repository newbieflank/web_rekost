<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
</style>

<!-- Form Profile -->
<div class="container">
    <div class="card m-5">
        <h5 class="card-header">Informasi Pribadi</h5>
        <div class="card-body">
            <div class="container mt-3 mb-5">
                <div class="imgProfile d-block mx-auto">
                    <img src="<?= BASEURL; ?>img/img1.png" class="rounded-circle d-block mx-auto" alt="">
                </div>
            </div>
            <form id="myForm" class="row m-5 custom-form" action="">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Masukan Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputKelamin" aria-label="Default select example">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="customDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customDate" placeholder="Pilih tanggal">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pekerjaan" placeholder="Masukan Pekerjaan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputSekolah" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputSekolah" aria-label="Default select example">
                            <option selected>Pilih Sekolah/Kampus</option>
                            <option value="Laki-Laki">Politeknik Negeri Jember</option>
                            <option value="Perempuan">Universitas Jember</option>
                            <option value="Hewan">Universitas Bondowoso</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kotaAsal" class="col-sm-2 col-form-label">Kota Asal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kotaAsal" placeholder="Masukan Kota Asal">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="noTelp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="noTelp" placeholder="Masukan No Telp">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" id="saveBtn">Save Change</button>
                    <button type="button" id="resetBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>