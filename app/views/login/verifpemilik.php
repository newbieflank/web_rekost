<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('css/verifpemilik.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="card p-4 shadow-sm" style="max-width: 500px; width: 100%;">
            <h2 class="card-title text-center">Upload Dokumen dan Persetujuan</h2>
            <p class="text-center">Pastikan dokumen sesuai dengan persyaratan yang berlaku.</p>

            <form action="<?= BASEURL; ?>verif" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php if (isset($data['username']) && !empty($data['username'])): ?>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control mb-3" id="username" value="<?= htmlspecialchars($data['username']) ?>" readonly placeholder="username">
                    <?php endif; ?>

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control mb-3" id="email" value="<?= htmlspecialchars($data['email']) ?>" readonly placeholder="Email">

                    <?php if (isset($data['number']) && !empty($data['number'])): ?>
                        <label for="number" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control mb-3" id="number" value="<?= htmlspecialchars($data['number']) ?>" readonly placeholder="No. Telepon">
                    <?php endif; ?>

                    <label for="file" class="form-label">Upload Lampiran (KTP atau Surat Izin Usaha)</label>
                    <input type="file" class="form-control mb-3" id="file" name="file" required placeholder="Upload KTP">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agreement" required>
                    <label class="form-check-label" for="agreement">Saya menyetujui <a href="#" target="_blank">syarat dan ketentuan</a> pembuatan kost di platform ini</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
            </form>
        </div>
    </div>
</body>

</html>