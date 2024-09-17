<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <style>
        @media (max-width: 768px) {
            .nav-item {
                margin-right: 10px;
            }

            .stats {
                flex-direction: column;
                align-items: center;
            }
        }

        .nav-item {
            margin-right: 20px;
        }

        .main-content {
            text-align: center;
            padding: 2rem;
        }

        .navbar {
            padding: 20px 0;
            box-shadow: 0 4px 8px 0 rgba(158, 158, 158, 0.2);
        }

        .navbar-btn {
            padding: 10px 24px;
            font-size: 14px;
        }

        .navbar-btn.btn-outline-secondary {
            color: #5d58af;
            border-color: #5d58af;
            font-weight: semibold;
        }

        .navbar-btn.btn-outline-secondary:hover {
            background-color: #ffffff;
            color: #000000;
            border-color: #5d58af;
        }

        .navbar-btn.btn-primary {
            background-color: #908aff;
            color: #ffffff;
            border: none;
            font-weight: semibold;
        }

        .navbar-btn.btn-primary:hover {
            background-color: #5d58af;
            color: #ffffff;
        }

        .navbar-nav {
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.svg" alt="Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-2 mb-lg-0" style="font-size: 1rem;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex" role="search" style="width: 200px;">
                    <button class="btn btn-outline-secondary navbar-btn me-2" type="button">Sign In</button>
                    <button class="btn btn-primary navbar-btn" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>