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

<!-- Form Data Kos -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Lengkapi Data Kos</h5>
        <div class="card-body">
            <form id="dataKosForm" class="row m-5 custom-form" action="<?= BASEURL; ?>datakos/tambah" method="post" onsubmit="handleSubmit(event)">
                <div class="mb-3 row">
                    <label for="nama_kos" class="col-sm-2 col-form-label">Nama Kos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namakos" name="nama_kos" placeholder="Masukan Nama Kos" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlahkamar" class="col-sm-2 col-form-label">Jumlah Kamar</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="jumlahkamar" name="jumlah_kamar" placeholder="Masukkan Jumlah Kamar" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tipe_kos" class="col-sm-2 col-form-label">Disewakan Untuk</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe_kos" id="putra" value="Putra" required>
                            <label class="form-check-label" for="putra">Putra</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe_kos" id="putri" value="Putri">
                            <label class="form-check-label" for="putri">Putri</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe_kos" id="campur" value="Campur">
                            <label class="form-check-label" for="campur">Campur</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Kos</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="deskripsikos" name="deskripsi" placeholder="Tuliskan deskripsi kos anda..." rows="3" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="peraturan_kos" class="col-sm-2 col-form-label">Peraturan Kos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="peraturan_kos" name="peraturan_kos" placeholder="Tentukan aturan kos disini..." required>
                    </div>
                </div>

                <div class="text-end mx-5">
                    <button type="submit" class="btn btn-lanjut">
                        Simpan & Lanjutkan <i class="fas fa-chevron-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
async function handleSubmit(event) {
    event.preventDefault();
    
    try {
        const form = event.target;
        const formData = new FormData(form);
        
        // submit data 
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            // Angsung direct ke fasilttaskos
            window.location.href = '<?= BASEURL; ?>fasilitaskos';
        } else {
            throw new Error('Form submission failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}
</script>