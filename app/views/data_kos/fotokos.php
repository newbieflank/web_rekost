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
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 8px;
    }

    .btn-lanjut {
        background-color: #303030;
        color: #FFFFFF;
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

    .tips {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: transparent;
        margin-bottom: 0;
        padding: 5px 10px; 
        font-size: 14px; 
        border: 1px solid #d3d3d3; 
        border-radius: 5px; 
    }

    .tips i {
        color: #4a4af3;
    }

    .tips a {
        color: #76CA74;
        text-decoration: none;
        margin-left: 10px;
    }

    .tips a:hover {
        text-decoration: underline;
    }
</style>
<!-- Foto Kos -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Pasang Foto Kos
            <div class="tips">
                <div>
                    <i class="fas fa-info-circle"></i>
                    Tips upload foto
                </div>
                <a href="#">Lihat tips</a>
            </div>
        </h5>
        <div class="card-body">
            <form id="myForm" class="row m-5 custom-form" method="post" action="update">
                <div class="row g-1">
                    <div class="col-md-6">
                        <h2 class="font-semibold mb-2">Foto bangunan depan</h2>
                        <p class="text-sm text-gray-500 mb-4">Foto horizontal akan terlihat lebih bagus sebagai foto
                            utama kos.</p>
                        <div class="photo-box">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan depan</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="font-semibold mb-2">Foto bangunan dari belakang</h2>
                        <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan kos dari belakang ke calon penyewa.
                        </p>
                        <div class="photo-box">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan dari belakang</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="font-semibold mb-2">Foto bangunan dalam</h2>
                        <p class="text-sm text-gray-500 mb-4">Perlihatkan suasana di dalam dengan cahaya terang agar
                            terlihat lebih jelas</p>
                        <div class="photo-box">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto dalam bangunan</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="font-semibold mb-2">Foto bangunan dari jalan</h2>
                        <p class="text-sm text-gray-500 mb-4">Tunjukkan lingkungan sekitar depan kos ke calon penyewa.
                        </p>
                        <div class="photo-box">
                            <i class="fas fa-camera"></i>
                            <p class="text-gray-400">Tambah foto bangunan dari jalan</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="text-end mb-4">
        <a href="popular">
            <button type="submit" form="myForm" class="btn btn-lanjut">Lanjutkan<i
                    class="fas fa-chevron-right ms-2"></i></button>
        </a>
    </div>
</div>