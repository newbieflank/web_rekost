<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="<?= asset('css/profile.css') ?>">
<script src="<?= asset('js/profile.js') ?>"></script>




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

    #alamat {
        resize: none;
    }
</style>

<!-- Form Profile -->
<div class="container">
    <div class="card m-4">
        <h5 class="card-header">Informasi Pribadi</h5>
        <div class="card-body">
            <div class="container mt-3 mb-5">
                <div class="imgProfile d-block mx-auto">
                    <!-- Clickable Image -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#changeImageModal">
                        <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/Vector.svg') ?>" class="rounded-circle d-block mx-auto" alt="Profile Image" style="cursor: pointer;">
                    </a>
                </div>
            </div>
            <form id="myForm" class="row m-5 custom-form" method="post" action="<?= BASEURL; ?>profile/update">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Lengkap" value="<?php echo $username ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputGender" name="inputGender" aria-label="Default select example">
                            <option value="" <?php echo empty($gender) ? 'selected' : ''; ?>>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" <?php echo (isset($gender) && $gender == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo (isset($gender) && $gender == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="customDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="customDate" name="customDate" placeholder="Pilih tanggal" value="<?php echo $tanggal ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="status" name="status" aria-label="Default select example">
                            <option value="" <?php echo empty($status) ? 'selected' : ''; ?>>Pilih Status</option>
                            <option value="Menikah" <?php echo (isset($status) && $status == 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                            <option value="Belum Menikah" <?php echo (isset($status) && $status == 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukan Pekerjaan" value="<?php echo $pekerjaan ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputInstansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputInstansi" id="inputInstansi" placeholder="Masukan Nama Instansi" value="<?php echo $instansi ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kotaAsal" class="col-sm-2 col-form-label">Kota Asal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kotaAsal" name="kotaAsal" placeholder="Masukan Kota Asal" value="<?php echo $kota ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="noTelp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="noTelp" name="noTelp" placeholder="Masukan No Telp" value="<?php echo $nomor ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" placeholder="masukan alamat" class="form-control"><?= $alamat ?></textarea>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" form="myForm" id="saveBtn">Save Change</button>
                    <button type="button" id="resetBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changeImageModal" tabindex="-1" aria-labelledby="changeImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeImageModalLabel">Change Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeImageForm" action="<?= BASEURL; ?>upImg" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Choose New Profile Image</label>
                        <input type="file" class="form-control" id="file" name="file" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>