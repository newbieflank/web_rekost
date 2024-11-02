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
            <form id="fasilitasForm" class="row m-5 custom-form" action="<?= BASEURL; ?>fasilitaskos/tambah" method="post" onsubmit="handleSubmitFasilitas(event)">
                <div class="mb-3 row">
                    <label for="fasilitasumum" class="col-sm-2 col-form-label">Fasilitas Umum</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fasilitasumum" name="fasilitas_umum" placeholder="Masukkan fasilitas umum..." required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fasilitaskamar" class="col-sm-2 col-form-label">Fasilitas Kamar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fasilitaskamar" name="fasilitas_kamar" placeholder="Masukkan fasilitas kamar..." required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kamarmandi" class="col-sm-2 col-form-label">Fasilitas Kamar Mandi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kamarmandi" name="fasilitas_kamar_mandi" placeholder="Masukkan fasilitas kamar mandi..." required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="parkir" class="col-sm-2 col-form-label">Fasilitas Parkir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="parkir" name="fasilitas_parkir" placeholder="Masukkan fasilitas parkir..." required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="luar" class="col-sm-2 col-form-label">Fasilitas Luar</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" id="luar" name="fasilitas_luar" placeholder="Masukkan fasilitas luar kos..." required>
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
async function handleSubmitFasilitas(event) {
    event.preventDefault();
    
    try {
        const form = event.target;
        const formData = new FormData(form);
        
        // Submit form data
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            // Redirect to alamat kos page after successful submission
            window.location.href = '<?= BASEURL; ?>alamatkos';
        } else {
            throw new Error('Form submission failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}
</script>