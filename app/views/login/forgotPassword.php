<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            height: 500px;
            position: relative;
        }

        .btn-primary {
            background-color: #1a1a3d;
            border: none;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #141432;
        }

        .form-control {
            border-radius: 5px;
        }

        .link {
            color: #1a1a3d;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        .signup-link {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: #6c757d;
        }

        .signup-link .bold {
            font-weight: 600;
            color: #1a1a3d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Did you forget your password?</h2>
        <p>Enter your email address and we will send you a password reset link.</p>
        <div class="row">
            <div class="mb-3">
                <?php if (isset($_SESSION['flash'])): ?>
                    <?php Flasher::flash(); ?>
                <?php endif; ?>
            </div>
        </div>
        <form action="<?= BASEURL ?>forgetPassword" method="post">
            <div class="mb-4 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="admin@gmail.com" value="<?= $email ?? null ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100">Forgot Password</button>
        </form>
        <div class="mt-3">
            <a href="<?= BASEURL; ?>login" class="link">Back to Sign In</a>
        </div>
        <div class="signup-link">
            You don't have an account? <a href="<?= BASEURL; ?>register" class="bold">Sign up</a>
        </div>
    </div>
</body>

<script>
    history.pushState(null, null, location.href);

    window.onpopstate = function() {
        window.location.href = 'login';
    };
</script>