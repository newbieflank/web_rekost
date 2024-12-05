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
                    <th>Ulasan Kos</th>
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
                        <td class="text-center">
                            <a href="#"
                                class="btn btn-sm btn-primary view-proof"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                data-image="<?= asset('uploads/' . $id_user . '/' . $transaksi['id_penyewaan'] . '.jpg') ?>">
                                Lihat Bukti
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="#"
                                class="btn btn-sm btn-warning give-rating"
                                data-bs-toggle="modal"
                                data-bs-target="#ratingModal"
                                data-id="<?= $transaksi['id_penyewaan'] ?>">
                                Rating
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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

<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Berikan Rating</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ratingForm">
                    <div class="mb-3 text-center">
                        <label for="rating" class="form-label">Rating:</label>
                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <i class="bi bi-star" data-rating="<?= $i ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" id="ratingValue" name="rating">
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Review:</label>
                        <textarea id="review" class="form-control" name="review" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('give-rating')) {
                const idTransaksi = event.target.getAttribute('data-id');
                $('#ratingForm').data('id', idTransaksi);
            }
        });
        $('#ratingForm').on('submit', function(event) {
            event.preventDefault();
            const idTransaksi = $(this).data('id');
            const rating = $('#ratingValue').val();
            const review = $('#review').val();

            console.log({
                idTransaksi,
                rating,
                review
            });
            $('#ratingModal').modal('hide');
        });

        $('.rating i').on('click', function() {
            const rating = $(this).data('rating');
            $('#ratingValue').val(rating);
            $('.rating i').removeClass('bi-star-fill').addClass('bi-star');
            $(this).prevAll().addBack().removeClass('bi-star').addClass('bi-star-fill');
        });
    });
</script>