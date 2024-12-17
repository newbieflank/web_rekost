<link rel="stylesheet" href="<?= asset('css/loginPage.css') ?>">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
    @media (max-width: 1024px) {
        .Page img {
            display: none;
        }

        .content .logo {
            display: block;
            position: absolute;
            top: -20;
            left: -20;
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
<div class="Page">
    <div class="content">
        <img class="logo" src="<?= asset('img/ImageLoginLogo.svg') ?>" alt="">
        <h2>Selamat Datang</h2>
        <p>Selamat Datang di laman Re-kost! Tempat terbaik untuk mencari rekomendasi kost</p>

        <form method="post" action="<?= BASEURL ?>login">
            <div class="row">
                <div class="col-lg-6">
                    <?php if (isset($_SESSION['flash'])): ?>
                        <?php Flasher::flash(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <label for="username">Email or Username</label>
            <input type="text" name="username" id="username" placeholder="example@gmail.com" required>
            <div class="password-section">
                <label for="password">Password</label>
                <img class="showPass" src="<?= asset('img/eyePass.svg') ?>" alt="" onclick="togglePassword()">
            </div>
            <input type="password" name="password" id="password" placeholder="Masukan Password" required>
            <div class="remember-section">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="separator">
            <span>Or</span>
        </div>
        <a href="<?= BASEURL; ?>auth" class="button-link">
            <img src="<?= asset('img/googleIcon.svg') ?>" alt="Logo" class="button-logo">
            Sign In With Google
        </a>
    </div>

    <div class="img-wrap">
        <img src="<?= asset('img/ImageLogin.svg') ?>" alt="">
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
    }

    // Mencegah tombol back di browser
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
    };
</script>