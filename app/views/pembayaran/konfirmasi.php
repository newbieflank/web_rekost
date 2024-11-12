<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('css/konfirmasi.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/../layout/header.php'; ?>
    <section class="container my-4">
        <div class="d-flex align-items-center">
            <button class="btn btn-danger me-3">
                <i class="bi bi-chevron-left"></i> Kembali
            </button>
            <h2>Konfirmasi Pemesanan</h2>
        </div>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-circle"></i> Pemesanan Anda Ditunda
                    <p>Lakukan pembayaran <strong>sekarang.</strong></p>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Unggah Bukti Pembayaran</h5>
                        <p>Silakan unggah bukti pembayaran Anda agar pemesanan dapat diproses lebih lanjut.</p>
                        <div class="mb-3">
                            <label for="paymentProof" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="paymentProof" accept="image/*,application/pdf">
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Pemesanan</h5>
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i> Data Sudah Sesuai.
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Nama Lengkap</strong></p>
                                <p>Mafira Aurelia</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Email</strong></p>
                                <p>example@gmail.com</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Nomor Telepon</strong></p>
                                <p>089123456789</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Detail Pemesanan</h5>
                        <p>Harap isi formulir di bawah ini. Masukkan detail pesanan anda.</p>
                        <form>
                            <div class="mb-3">
                                <label for="kosName" class="form-label">Nama Kos</label>
                                <input type="text" class="form-control" id="kosName" value="Kos Putri Muslimah" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="totalKamar" class="form-label">Total Kamar</label>
                                <input type="text" class="form-control" id="totalKamar" value="1 Kamar">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="location" value="Jl. Blindungan, Bondowoso" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="startDate" value="2024-02-01">
                            </div>
                            <div class="mb-3">
                                <label for="endDate" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="endDate" value="2024-03-01">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-card p-3 border rounded">
                    <div class="mb-4">
                        <img src="<?= asset('img/home1.png') ?>" class="w-100" alt="Kos Image">
                    </div>
                    <h5>Detail Pembayaran</h5>
                    <p><strong>Nama Kos</strong>: Kos Putri Muslimah</p>
                    <p><strong>Total Kamar</strong>: <span id="detailTotalKamar">1 Kamar</span></p>
                    <p><strong>Lokasi</strong>: Jl. Blindungan, Bondowoso</p>
                    <p><strong>Tanggal</strong>: <span id="detailTanggal">01 Feb - 01 Mar</span></p>
                    <p><strong>Harga</strong>: Rp 1.000.000</p>
                    <p><strong>Pajak dan Biaya</strong>: Rp 0</p>
                    <p class="total"><strong>Total:</strong> Rp 1.000.000</p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                        <label class="form-check-label" for="termsCheck">
                            Setuju dengan Ketentuan <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>
                    <button class="btn btn-primary w-100">Seleseai</button>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.btn-primary').addEventListener('click', function(event) {
            event.preventDefault();

            const paymentProof = document.getElementById('paymentProof').files.length;

            if (paymentProof > 0) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Pembayaran Berhasil Dilakukan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Silakan unggah bukti pembayaran terlebih dahulu.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
    <script>
        document.getElementById('totalKamar').addEventListener('input', function() {
            const totalKamar = this.value;
            document.getElementById('detailTotalKamar').textContent = totalKamar;
        });

        document.getElementById('startDate').addEventListener('input', updateTanggal);
        document.getElementById('endDate').addEventListener('input', updateTanggal);

        function updateTanggal() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (startDate && endDate) {
                const formattedStartDate = new Date(startDate).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                const formattedEndDate = new Date(endDate).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                document.getElementById('detailTanggal').textContent = `${formattedStartDate} - ${formattedEndDate}`;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg6tv6WJoREp+lG1er1kLtmYlP9+MVRt+8aK9I2GxD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pZfHC6QpZrK3Qe2m6Qm5Q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5Y5q
</body>

</html>