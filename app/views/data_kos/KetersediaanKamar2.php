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
    }

    .btn-lanjut {
        background-color: #303030;
        color: #FFFFFF;
    }


    .room-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .room-card {
        background-color: #F9F9FF;
        border: 1px solid #E0E0FF;
        border-radius: 10px;
        padding: 20px;
        position: relative;
        margin-left: 90px;
        width: 400px;
    }

    .room-card h3 {
        font-size: 16px;
        font-weight: 600;
        color: #4A4A4A;
        margin-bottom: 10px;
    }

    .room-card input {
        width: 100%;
        padding: 10px;
        border: 1px solid #E0E0FF;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .room-card .status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #4A4A4A;
        width: 100%;
    }

    .room-card .status i {
        margin-left: 5px;
        margin-right: 0;
    }

    .room-card .status i.fa-check-circle {
        color: #4CAF50;
        font-size: 1.2em;
    }

    .room-card .status i.fa-circle {
        color: #E0E0FF;
        font-size: 1.2em;
    }

    .room-card .number {
        position: absolute;
        top: -15px;
        left: -35px;
        border: 1px solid #E0E0FF;
        color: #000000;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }


    .footer-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .footer-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        margin-left: 10px;
    }

    .footer-buttons .btn-primary {
        background-color: #6C63FF;
        color: #FFFFFF;
    }

    .footer-buttons .btn-secondary {
        background-color: #4A4A4A;
        color: #FFFFFF;
    }

    .filter-buttons {
        display: flex;
        justify-content: flex-end;
    }

    .filter-buttons button {
        background-color: #E0E0FF;
        border: 2px solid #4A4A4A;
        border-radius: 20px;
        padding: 10px 20px;
        margin-left: 10px;
        font-size: 14px;
        color: #4A4A4A;
        cursor: pointer;
    }

    .filter-buttons button.active {
        background-color: #6C63FF;
        color: #FFFFFF;
        border: 2px;
    }
</style>

<!-- Form Ketersediaan Kamar -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">
            <span>Ketersediaan Kamar</span>
            <div class="filter-buttons">
                <button class="active">Semua</button>
                <button>Terisi</button>
                <button>Kosong</button>
            </div>
        </h5>
        <div class="card-body">
            <form id="myForm" class="m-5 custom-form" method="post" action="update">
                <div class="room-grid">
                    <div class="room-card">
                        <div class="number">
                            1
                        </div>
                        <h3>
                            Nomor/Nama Kamar
                        </h3>
                        <input readonly="" type="text" value="1" />
                        <h3>
                            Fasilitas Kamar
                        </h3>
                        <input type="text" placeholder="1" />
                        <div class="status">
                            Kamar sudah terisi
                            <i class="fas fa-check-circle">
                            </i>
                        </div>
                    </div>
                    <div class="room-card">
                        <div class="number">
                            2
                        </div>
                        <h3>
                            Nomor/Nama Kamar
                        </h3>
                        <input type="text" placeholder="2" />
                        <h3>
                            Fasilitas Kamar
                        </h3>
                        <input readonly="" type="text" value="1" />
                        <div class="status">
                            Kamar sudah terisi
                            <i class="fas fa-circle">
                            </i>
                        </div>
                    </div>
                    <div class="room-card">
                        <div class="number">
                            3
                        </div>
                        <h3>
                            Nomor/Nama Kamar
                        </h3>
                        <input type="text" placeholder="3" />
                        <h3>
                            Fasilitas Kamar
                        </h3>
                        <input readonly="" type="text" value="1" />
                        <div class="status">
                            Kamar sudah terisi
                            <i class="fas fa-circle">
                            </i>
                        </div>
                    </div>
                    <div class="room-card">
                        <div class="number">
                            4
                        </div>
                        <h3>
                            Nomor/Nama Kamar
                        </h3>
                        <input type="text" placeholder="4" />
                        <h3>
                            Fasilitas Kamar
                        </h3>
                        <input readonly="" type="text" value="1" />
                        <div class="status">
                            Kamar sudah terisi
                            <i class="fas fa-circle">
                            </i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-buttons">
        <div class="text-end mx-3 mb-4">
            <a href="popular">
                <button type="submit" form="myForm" class="btn-primary">Selesai Atur ketersediaan</button>
            </a>
        </div>
        <div class="text-end mb-4">
            <a href="popular">
                <button type="submit" form="myForm" class="btn btn-lanjut">Lanjutkan<i
                        class="fas fa-chevron-right ms-2"></i></button>
            </a>
        </div>
    </div>
</div>