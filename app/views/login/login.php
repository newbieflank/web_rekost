<link rel="stylesheet" href="css/loginPage.css">
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
        <img class="logo" src="img/ImageLoginLogo.svg" alt="">
        <h2>Selamat Datang</h2>
        <p>Selamat Datang di laman Re-kost! Tempat terbaik untuk mencari rekomendasi kost</p>

        <form action="">
            <label for="username">Email or Username</label>
            <input type="text" name="username" id="username" placeholder="example@gmail.com" required>
            <div class="password-section">
                <label for="password">Password</label>
                <img class="showPass" src="img/eyePass.svg" alt="" onclick="togglePassword()">
            </div>
            <input type="password" name="password" id="password" placeholder="Masukan Password" required>
            <div class="remember-section">
                <input type="checkbox" id="remember">
                <label for="remember">Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="separator">
            <span>Or Sign Up With</span>
        </div>
        <a href="" class="button-link">
            <img src="img/googleIcon.svg" alt="Logo" class="button-logo">
            Sign In With Google
        </a>
    </div>

    <div class="img-wrap">
        <img src="img/ImageLogin.svg" alt="">
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
    }
</script>