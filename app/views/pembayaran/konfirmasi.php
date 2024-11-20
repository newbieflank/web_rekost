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
        <form action="<?= BASEURL; ?>pembayaran" method="post" enctype="multipart/form-data">
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

                                <input type="file" class="form-control" name="buktiPembayaran" id="paymentProof" accept="image/*,application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Pemesanan</h5>
                            <div id="alertMessage" class="alert d-none" role="alert"></div>
                            <form id="formPemesanan">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="namaLengkap" class="form-label"><strong>Nama Lengkap</strong></label>
                                        <input type="text" name="nama" class="form-control" id="namaLengkap" placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nomorTelepon" class="form-label"><strong>Nomor Telepon</strong></label>
                                        <input type="tel" name="telepon" class="form-control" id="nomorTelepon" placeholder="Masukkan nomor telepon">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Detail Pemesanan</h5>
                            <p>Harap isi formulir di bawah ini. Masukkan detail pesanan anda.</p>
                            <div class="mb-3">
                                <label for="kosName" class="form-label">Nama Kos</label>
                                <input type="text" class="form-control" id="kosName" value="<?= $kos['nama_kos'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="totalKamar" class="form-label">Total Kamar</label>
                                <input type="number" name="totalKamar" class="form-control" id="totalKamar" value="1 Kamar">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" id="location" value="<?= $kos['alamat'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Tanggal</label>
                                <select id="duration" name="waktu_penyewaan" class="form-select">
                                    <option value="1">Harian</option>
                                    <option value="2">Mingguan</option>
                                    <option value="3">1 Bulan</option>
                                    <option value="4">3 Bulan</option>
                                    <option value="5">1 Tahun</option>
                                </select>
                            </div>
                            <div id="DayInput" class="mb-3 d-none">
                                <label for="customDays" class="form-label">Masukkan Jumlah Hari</label>
                                <input type="number" id="customDays" class="form-control" min="1" placeholder="Jumlah hari">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-card p-3 border rounded">
                        <div class="mb-4">
                            <img src="<?= asset('img/home1.png') ?>" class="w-100" alt="Kos Image">
                        </div>
                        <h5>Detail Pembayaran</h5>
                        <p><strong>Nama Kos</strong>: <?= $kos['nama_kos'] ?></p>
                        <p><strong>Total Kamar</strong>: <span id="detailTotalKamar">1</span></p>
                        <p><strong>Lokasi</strong>: <?= $kos['alamat'] ?></p>
                        <p><strong>Tanggal</strong>: <span id="detailTanggal"></span></p>
                        <p><strong>Harga</strong>: <?= $kos['harga'] ?></p>
                        <p class="total"><strong>Total:</strong><span id="idTotal"></span></p>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                            <label class="form-check-label" for="termsCheck">
                                Setuju dengan Ketentuan <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a>
                            </label>
                        </div>
                        <input type="hidden" name="id_kos" class="form-control" id="location" value="<?= $kos['id_kos'] ?>" readonly>
                        <input type="hidden" name="id_kamar" class="form-control" id="location" value="<?= $kos['id_kamar'] ?>" readonly>
                        <input type="hidden" name="totalHarga" class="form-control" id="totalHarga" readonly>

                        <button class="btn btn-primary w-100" type="submit" id="btnSelesai">Seleseai</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-card p-3 border rounded">
                    <div class="mb-4">
                        <img src="<?= asset('img/home1.png') ?>" class="w-100" alt="Kos Image">
                    </div>
                    <h5>Detail Pembayaran</h5>
                    <p><strong>Nama Kos</strong>: <?= $kos['nama_kos'] ?></p>
                    <p><strong>Total Kamar</strong>:  <span id="detailTotalKamar">1</span></p>
                    <p><strong>Lokasi</strong>: <?= $kos['alamat'] ?></p>
                    <p><strong>Tanggal</strong>: <span id="detailTanggal"></span></p>
                    <p><strong>Harga</strong>: <?= $kos['harga'] ?></p>
                    <p class="total"><strong>Total:</strong><span id="idTotal"></span></p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                        <label class="form-check-label" for="termsCheck">
                            Setuju dengan Ketentuan <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>
                    <button class="btn btn-primary w-100" id="btnSelesai">Seleseai</button>
                </div>
            </div>
        </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("btnSimpan").addEventListener("click", function() {
            const namaLengkap = document.getElementById("namaLengkap").value.trim();
            const email = document.getElementById("email").value.trim();
            const nomorTelepon = document.getElementById("nomorTelepon").value.trim();
            const alertMessage = document.getElementById("alertMessage");

            if (namaLengkap === "" || email === "" || nomorTelepon === "") {
                alertMessage.className = "alert alert-danger";
                alertMessage.textContent = "Silahkan lengkapi semua data!";
                alertMessage.classList.remove("d-none");
            } else {
                alertMessage.className = "alert alert-success";
                alertMessage.textContent = "Data berhasil disimpan.";
                alertMessage.classList.remove("d-none");
            }
        });
    </script>
    <script>
        document.getElementById("btnSelesai")?.addEventListener("click", function(event) {

            const paymentProof = document.getElementById('paymentProof').files.length;

            if (paymentProof > 0) {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Pembayaran Berhasil Dilakukan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                event.preventDefault();
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
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }

        function setTotalHarga(harga) {
            document.querySelector('#idTotal').textContent = formatRupiah(harga);
            console.log(harga);

            document.querySelector('#totalHarga').value = harga;
        }
        setTotalHarga(<?= (int) $kos['harga'] ?>)
    </script>
    <script>
        let totalKamar = 1;
        document.getElementById('totalKamar').addEventListener('input', function() {
            totalKamar = this.value.replace(/[^0-9]/g, '');
            document.getElementById('detailTotalKamar').textContent = totalKamar;
        });
        document.getElementById('duration').addEventListener('change', function() {
            const duration = parseInt(this.value);
            const hargaKos = <?= $kos['harga'] ?>;
            const totalKamar = parseInt(document.getElementById('totalKamar').value) || 1;

            let totalHarga = 0;

            if (duration === 1) {
                document.getElementById('DayInput').classList.remove('d-none');
                document.getElementById('customDays').addEventListener('input', function() {
                    const customDays = parseInt(this.value) || 0;
                    totalHarga = hargaKos * customDays * totalKamar;
                    updateTotalHarga(totalHarga);
                });
            } else {
                document.getElementById('DayInput').classList.add('d-none');
                let durationDays = 0;

                if (duration === 2) {
                    durationDays = 7;
                } else if (duration === 3) {
                    durationDays = 30;
                } else if (duration === 4) {
                    durationDays = 90;
                } else if (duration === 5) {
                    durationDays = 365;
                }

                totalHarga = hargaKos * durationDays * totalKamar;
                updateTotalHarga(totalHarga);
            }
        });

        function updateTotalHarga(totalHarga) {
            setTotalHarga(totalHarga);
        }




        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg6tv6WJoREp+lG1er1kLtmYlP9+MVRt+8aK9I2GxD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pZfHC6QpZrK3Qe2m6Qm5Q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5z5Y5q5Y5q" crossorigin="anonymous"></script>
</body>

</html>