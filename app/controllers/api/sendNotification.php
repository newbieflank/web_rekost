<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Path ke file kredensial
$firebaseCredentialsPath = __DIR__ . '/../../../rekos.json';  // Sesuaikan path dengan lokasi file Anda

// Inisialisasi Firebase dengan kredensial service account
$serviceAccount = ServiceAccount::fromJsonFile($firebaseCredentialsPath);
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->createMessaging();

// Ambil data dari request (misalnya token dan pesan)
$requestData = json_decode(file_get_contents('php://input'), true);
$token = $requestData['token'] ?? null;
$title = $requestData['title'] ?? 'Default Title';
$body = $requestData['body'] ?? 'Default Body';

if (!$token) {
    die(json_encode(['error' => 'Token is required']));
}

// Menyiapkan pesan notifikasi
$message = [
    'token' => $token,
    'notification' => [
        'title' => $title,
        'body' => $body,
    ]
];

// Kirim pesan menggunakan Firebase Admin SDK
try {
    $firebase->send($message);
    echo json_encode(['status' => 'Notification sent successfully']);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

