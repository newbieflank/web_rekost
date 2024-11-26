<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?= asset('css/konfirmasi.css') ?>">
<div class="container mt-4">
    <h2>Riwayat Transaksi</h2>
    <div class="table-responsive mt-4">
        <table id="userTable" class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Waktu Penyewaan</th>
                    <th>Harga</th>
                    <th>Bukti Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($riwayat as $transaksi) :
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $transaksi['id_penyewaan'] ?></td>
                        <td><?= $transaksi['tanggal_penyewaan'] ?></td>
                        <td><?= $transaksi['waktu_penyewaan'] ?></td>
                        <td><?= $transaksi['harga_kos'] ?></td>
                        <td>
                            <a href="#"
                                class="btn btn-sm btn-primary view-proof"
                                id="buktiTransaksi"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                data-image="<?= asset('uploads/' . $id_user . '/' . $transaksi['id_penyewaan'] . '.jpg') ?>">
                                Lihat Bukti
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Bukti Pembayaran">
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('view-proof')) {
                const imageUrl = event.target.getAttribute('data-image');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageUrl;
            }
        });
    });
</script>