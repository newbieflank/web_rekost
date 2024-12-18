<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <form>
            <div class="mb-4 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="admin@gmail.com">
            </div>
            <button type="submit" class="btn btn-primary w-100">Forgot Password</button>
        </form>
        <div class="mt-3">
            <a href="#" class="link">Back to Sign In</a>
        </div>
        <div class="signup-link">
            You don’t have an account? <a href="#" class="bold">Sign up</a>
        </div>
    </div>
</body>