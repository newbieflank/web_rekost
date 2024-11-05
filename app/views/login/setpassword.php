<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
    <link rel="stylesheet" href="<?= asset('css/set.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <form action="<?= BASEURL; ?>create" method="post">
        <div class="row">
            <div class="col-lg-6">
                <?php if (isset($_SESSION['flash'])): ?>
                    <?php Flasher::flash(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="password-container">
            <span class="close-btn">&times;</span>
            <h2>Set Password</h2>
            <p>Pastikan password yang anda masukkan benar</p>
            <div class="mb-3">
                <input type="hidden" name="username" id="username" value="<?php echo $data['name'] ?>">
                <input type="hidden" name="email" id="email" value="<?php echo $data['email'] ?>">
                <select class="form-select" name="role" id="role">
                    <option value="" selected>Daftar Sebagai</option>
                    <option value="pencari kos">Pencari Kost</option>
                    <option value="pemilik kos">Pemilik Kost</option>
                </select>
                <label for="Password" class="form-label">Password</label>
                <div class="form-control position-relative">
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your Password">
                    <i class="fas fa-eye toggle-password position-absolute end-0 me-3 mt-2" style="cursor: pointer;"></i>
                </div>
                <small class="form-text text-muted">Minimal 8 karakter</small>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <div class="form-control position-relative">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                    <i class="fas fa-eye toggle-password position-absolute end-0 me-3 mt-2" style="cursor: pointer;"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
    </form>

    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    </script>
</body>

</html>