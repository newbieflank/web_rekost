<link rel="stylesheet" href="css/registerPage.css">
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
        <img lass="imgbanner" src="img/ImageLogin.svg" alt="Image">
    </div>


    <div class="login-content">
        <img class="loginImage" src="img/ImageLoginLogo.svg" alt="">
        <h2>Get Started!</h2>
        <p>Already have an account? <a href="login">Sign In?</a></p>


        <form action="">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Enter full name" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <label for="number">Phone Number</label>
            <input type="tel" name="number" id="number" placeholder="Enter phone number" required>
            <div class="password-section">
                <label for="password">Password</label>
                <img class="showPass" src="img/eyePass.svg" alt="" onclick="togglePassword()">
            </div>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <button type="submit">Create account</button>
        </form>
        <div class="separator">
            <span>Or</span>
        </div>
        <a href="" class="button-link">
            <img src="img/googleIcon.svg" alt="Logo" class="button-logo">
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