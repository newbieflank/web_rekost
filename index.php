<?php

if (!session_start()) {
    session_set_cookie_params(0);
    session_start();
}



if (isset($_COOKIE['user'])) {
    $_SESSION['user'] = json_decode($_COOKIE['user'], true);
}

$file = './.env';

if (!file_exists($file)) {
    throw new Exception("File .env tidak ditemukan: $file");
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
        continue;
    }

    list($key, $value) = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

require './vendor/autoload.php';
require_once './config/config.php';
require_once './app/helpers/FileUploadHelper.php';
require_once './app/core/Controller.php';
require_once './app/core/Flasher.php';
require_once './app/core/Database.php';
require_once './app/core/Router.php';
require_once './app/core/Helper.php';
require_once './app/core/App.php';

// $output = shell_exec('pm2 status server | grep "online"');
// if (empty($output)) {
//     shell_exec('pm2 start ./server/server.js --name server');
// }

$output = shell_exec('ps aux | grep "[n]ode ./server/server.js"');

if (empty($output)) {
    shell_exec('node ./server/server.js > /dev/null 2>&1 &');
}
// // index.php
// if (isset($_GET['url'])) {
//     $url = $_GET['url'];  // Ambil URL yang dikirim

//     // Panggil controller sesuai dengan URL
//     if ($url == 'app/controllers/api/UpdateFcmToken.php') {
//         require_once 'app/controllers/api/UpdateFcmToken.php';
//         $controller = new UpdateFcmToken();
//         $controller->update();  // Panggil method 'update' untuk memperbarui token
//     } else {
//         // Tambahkan logika untuk menangani URL lainnya
//         echo 'Page not found';
//     }
// } else {
//     echo 'URL parameter missing';
// }


$app = new App();
