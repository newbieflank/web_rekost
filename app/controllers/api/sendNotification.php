<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Kreait\Firebase\Factory;

class SendNotification extends Controller
{
    private $firebase;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/../../../rekos.json')
            ->createMessaging();
    }

    public function send($data)
    {
        $messaging = $this->firebase;

        if (empty($data['token']) || empty($data['harga'])) {
            return [
                'status' => 'error',
                'message' => 'Token atau harga tidak boleh kosong.'
            ];
        }

        if (!is_numeric($data['harga']) || $data['harga'] <= 0) {
            return [
                'status' => 'error',
                'message' => 'Harga tidak valid.'
            ];
        }

        $message = [
            'token' => $data['token'],
            'notification' => [
                'title' => 'Pembayaran Berhasil',
                'body' => 'Pembayaran Sebesar Rp ' . number_format($data['harga'], 0, ',', '.') . ' Berhasil',
            ],
        ];

        try {
            $response = $messaging->send($message);
            return [
                'status' => 'success',
                'response' => $response,
            ];
        } catch (Exception $e) {
            error_log('Error sending FCM: ' . $e->getMessage()); 
            return [
                'status' => 'error',
                'message' => 'Failed to send notification. ' . $e->getMessage(),
            ];
        }
    }
}    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['token']) || !isset($input['harga'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input. Token atau harga tidak ditemukan.',
        ]);
        exit;
    }

    $notification = new SendNotification();
    $response = $notification->send($input);

    echo json_encode($response);
}
?>
