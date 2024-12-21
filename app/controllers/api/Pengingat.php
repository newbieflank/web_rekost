<?php
require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../app/core/Controller.php';
require_once __DIR__ . '/../../../app/models/NotifModel.php'; 
use Kreait\Firebase\Factory;

class Pengingat extends Controller
{
    private $firebase;
    private $notificationModel;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/../../../rekos.json')
            ->createMessaging();

        $this->notificationModel = new NotifModel();
    }

    public function CekdanPush()
    {
        $data = $this->notificationModel->getNotifikasiDanFcmToken();

        foreach ($data as $item) {

            if ($item['sisa_hari'] <= 3 && $item['sisa_hari'] >= 0) {
                $this->sendNotification($item);
            }
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'notif dah kekkirim.',
        ]);
    }

    public function sendNotification($data)
    {
        $messaging = $this->firebase;

        $message = [
            'token' => $data['fcm_token'],
            'notification' => [
                'title' => 'JAGAN LUPA!!!',
                'body' => 'Masa sewa KOS anda akan berakhir dalam ' . $data['sisa_hari'] . ' hari.',
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
?>
