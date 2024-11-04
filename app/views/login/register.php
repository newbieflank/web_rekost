<link rel="stylesheet" href="<?= asset('css/registerPage.css') ?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
    @media (max-width: 1024px) {
        .loginPage img {
            display: none;
        }

        .login-content .loginImage {
            display: block;
            position: absolute;
            top: -20;
            right: -20;
            width: 100px;
            height: 80px;
        }

        .button-link .button-logo {
            display: block;
        }

        .password-section img {
            display: block;
        }
    }
</style>
<div class="loginPage">
    <div class="wrap-img">
        <img lass="imgbanner" src="<?= asset('img/ImageLogin.svg') ?>" alt="Image">
    </div>


    <div class="login-content">
        <img class="loginImage" src="<?= asset('img/ImageLoginLogo.svg') ?>" alt="">
        <h2>Get Started!</h2>
        <p>Already have an account? <a href="login">Sign In</a></p>


        <form action="<?= BASEURL; ?>register" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <?php if (isset($_SESSION['flash'])): ?>
                        <?php Flasher::flash(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <select class="form-select" name="role" id="role">
                <option value="" selected>Daftar Sebagai</option>
                <option value="pencari kos">Pencari Kost</option>
                <option value="pemilik kos">Pemilik Kost</option>
            </select>
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Enter full name" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <label for="number">Phone Number</label>
            <input type="text" inputmode="numeric" name="number" id="number" placeholder="Enter phone number" required>
            <div class="password-section">
                <label for="password">Password</label>
                <img class="showPass" src="<?= asset('img/eyePass.svg') ?>" alt="" onclick="togglePassword()">
            </div>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <button type="submit" name="register">Create account</button>
        </form>
        <div class="separator">
            <span>Or</span>
        </div>
        <a href="<?= BASEURL; ?>create" class="button-link">
            <img src="<?= asset('img/googleIcon.svg') ?>" alt="Logo" class="button-logo">
            Sign Up With Google
        </a>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
    }
</script>