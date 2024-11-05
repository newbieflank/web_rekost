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

    .modal-header {
        background-color: #e5e4ff;
    }

    .modal-footer .btn-primary {
        background-color: #303030;
        border-color: #303030;
    }

    .modal-footer .btn-primary:hover {
        background-color: #404040;
        border-color: #404040;
    }
</style>

<!-- Form Harga -->
<div class="container">
    <div class="card mx-auto mr-5 mt-5 mb-3">
        <h5 class="card-header">Harga</h5>
        <div class="card-body">
            <form id="hargaForm" class="row m-5 custom-form" action="<?= BASEURL; ?>harga/tambah" method="post">
                <div class="mb-3 row">
                    <label for="pertahun" class="col-sm-2 col-form-label">Harga Per Tahun</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_tahun" id="pertahun" placeholder="Rp.0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="perbulan" class="col-sm-2 col-form-label">Harga Per Bulan</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_kos" id="perbulan" placeholder="Rp.0"
                            required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="perminggu" class="col-sm-2 col-form-label">Harga Per Minggu</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_minggu" id="perminggu" placeholder="Rp.0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="perhari" class="col-sm-2 col-form-label">Harga Per Hari</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_hari" id="perhari" placeholder="Rp.0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="biayatambahan" class="col-sm-2 col-form-label">Biaya Tambahan (opsional)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="biaya_tambahan" id="biayatambahan"
                            placeholder="ex. Listrik.">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-lanjut">
                        Simpan <i class="fas fa-save ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Pop up data telah dikirim ke db -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data kos telah berhasil disimpan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="redirectToPopular()">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToPopular() {
        window.location.href = '<?= BASEURL; ?>popular';
    }

    document.getElementById('hargaForm').addEventListener('submit', async function (event) {
        event.preventDefault();

        try {
            const formData = new FormData(this);

            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            } else {
                throw new Error('Form submission failed');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    });


</script>