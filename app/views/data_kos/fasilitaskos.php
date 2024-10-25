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

<!-- Form Fasilitas Kos -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Fasilitas Kos</h5>
        <div class="card-body">
            <form id="myForm" class="row m-5 custom-form" method="post" action="update">
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