<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<? asset('js/file.js') ?>"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('css/profile.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        .navbar-nav.ml-auto {
            justify-content: flex-end;
        }

        .nav-item {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 600;
            color: #4a4a4a;
            font-size: 16px;
        }

        .navbar-toggler {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white ">
            <a class="navbar-brand" href="#">
                <img src="<?= asset('img/logo.png') ?>" alt="Re-Kost Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= BASEURL; ?>#home">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>#bookings">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>#contact">Contact</a>
                    </li>
                </ul>
                <div class="navbar-nav ml-auto mx-4 dropdown">
                    <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo isset($id_gambar) ? asset('uploads/' . $id_user . '/' . $id_gambar) : asset('img/Vector.svg') ?>" class="rounded-circle" alt="Profile Image" width="40px">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="<?= BASEURL; ?>profile">Profile</a>
                        <a class="dropdown-item" href="#services">Layanan Kost</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>