<html>

<head>
    <title>Set Password</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/set.css">
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
                <label for="Password" class="form-label">Password</label>
                <div class="form-control">
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter yourPassword">
                    <i class="fas fa-eye"></i>
                </div>
                <small class="form-text text-muted">Minimal 8 karakter</small>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <div class="form-control">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
    </form>
</body>

</html>