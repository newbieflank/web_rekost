<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Pastikan Anda menggunakan instance database yang benar
    }

    // Mendapatkan token FCM dari user berdasarkan ID
    public function getFcmTokenById($id_user)
    {
        $query = "SELECT fcm_token FROM user WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);

        return $this->db->single()['fcm_token']; // Mengambil fcm_token user
    }

    // Fungsi untuk mengirim push notification
    public function sendPushNotification($id_user, $title, $body)
    {
        $fcmToken = $this->getFcmTokenById($id_user);
        if (!$fcmToken) {
            return false; // Token tidak ditemukan
        }

        $factory = (new Factory)->withServiceAccount('./path/to/your/firebase-service-account.json');
        $messaging = $factory->createMessaging();

        // Membuat pesan push
        $message = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification([
                'title' => $title,
                'body' => $body,
            ]);

        try {
            // Mengirim pesan
            $messaging->send($message);
            return true;
        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            throw new Exception('Error sending message: ' . $e->getMessage());
        }
    }
}
?>