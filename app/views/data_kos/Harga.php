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

<!-- Form Harga -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Harga</h5>
        <div class="card-body">
            <form id="myForm" class="row m-5 custom-form" method="post" action="update">
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
                       <input type="number" class="form-control" id="perminggu"placeholder="Rp.0">
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