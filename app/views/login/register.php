<link rel="stylesheet" href="<?= BASEURL; ?>css/registerPage.css">
<style>
    @media (max-width: 1024px) {
        .loginPage img {
            display: none;
        }

        .login-content img {
            display: block;
            position: absolute;
            top: -20;
            right: -20;
            width: 100px;
            height: 80px;
        }
    }
</style>
<div class="loginPage">
    <div class="wrap-img">
        <img lass="imgbanner" src="<?= BASEURL; ?>img/ImageLogin.svg" alt="Image">
    </div>


    <div class="login-content">
        <img class="loginImage" src="<?= BASEURL; ?>img/ImageLoginLogo.svg" alt="">
        <h2>Get Started!</h2>
        <p>Already have an account? <a href="<?= BASEURL; ?>login">Sign In?</a></p>


        <form action="">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Enter full name" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <label for="number">Phone Number</label>
            <input type="tel" name="number" id="number" placeholder="Enter phone number" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <button type="submit">Create account</button>
        </form>
    </div>
</div>