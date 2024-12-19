<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Reset Your Password</h2>
        <div class="row">
            <div class="col-lg-6">
                <?php if (isset($_SESSION['flash'])): ?>
                    <?php Flasher::flash(); ?>
                <?php endif; ?>
            </div>
        </div>
        <p>Enter a new password below to change your password.</p>
        <form action="<?= BASEURL ?>forgetPassword/reset" method="POST">
            <input type="hidden" name="token" value="<?= $_GET['token'] ?? $token ?>">
            <div class="mb-4 text-start">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password">
                    <span class="input-group-text" onclick="togglePassword('password', this)">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-4 text-start">
                <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="konfirmasi" id="konfirmasi">
                    <span class="input-group-text" onclick="togglePassword('konfirmasi', this)">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script>
        function togglePassword(fieldId, iconElement) {
            const field = document.getElementById(fieldId);
            const icon = iconElement.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</body>