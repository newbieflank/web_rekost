<?php
require_once __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\Socket\Server as SocketServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;

class ChatServer implements MessageComponentInterface
{
    protected $clients;
    private $chatModel;
    private $lastCheckedTime;

    public function __construct()
    {

        $this->chatModel = $this->model('ChatModel');
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        // Ambil parameter query string (contohnya: ?user_id=123)
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryParams);

        if (isset($queryParams['user_id'])) {
            $userId = $queryParams['user_id'];

            // Perbarui status pengguna di database menjadi online
            $this->updateUserStatus($userId, 'online');

            // Kirim daftar pengguna online ke semua klien
            $this->broadcastOnlineUsers();
        }
    }


    // Mengambil status pengguna dari database
    private function broadcastOnlineUsers()
    {
        // Ambil daftar pengguna online dari database
        $onlineUsers = $this->chatModel->getOnlineUsers();

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'type' => 'online_users',
                'users' => $onlineUsers,
            ]));
        }
    }
    private function chats($userId)
    {

        // Ambil status pengguna dari database (misalnya, 'online' atau 'offline')
        return $this->chatModel->chats($userId);
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        // Ambil parameter query string
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryParams);

        if (isset($queryParams['user_id'])) {
            $userId = $queryParams['user_id'];

            // Perbarui status pengguna di database menjadi offline
            $this->updateUserStatus($userId, 'offline');

            // Kirim daftar pengguna online ke semua klien
            $this->broadcastOnlineUsers();
        }
    }


    private function updateUserStatus($userId, $status)
    {
        $stmt = $this->db->prepare("UPDATE user SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $userId,
        ]);
    }


    // Ketika pesan diterima
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        // Validasi data dan proses penyimpanan pesan
        if (isset($data['message']) && isset($data['receiver_id'])) {
            $senderId = isset($data['sender_id']) ? $data['sender_id'] : null;
            $receiverId = $data['receiver_id'];
            $message = $data['message'];

            if ($senderId && $receiverId) {
                // Simpan pesan ke database melalui ChatModel
                if ($this->chatModel->sendMessage([
                    'id_sender' => $senderId,
                    'id_receiver' => $receiverId,
                    'message' => $message
                ])) {
                    // Kirimkan pesan ke semua klien yang terhubung (kecuali pengirim)
                    $responseMessage = json_encode([
                        'type' => 'message',
                        'id' => uniqid(),
                        'message' => $message,
                        'sender_id' => $senderId,
                        'receiver_id' => $receiverId,
                        'time' => date('H:i'),
                        'sent_by_user' => true // Menandakan pesan dikirim oleh pengguna
                    ]);

                    foreach ($this->clients as $client) {
                        // Kirimkan pesan ke semua klien kecuali pengirim
                        if ($client !== $from) {
                            $client->send($responseMessage);
                        }
                    }
                }
            }
        }
    }

    // Ketika terjadi error
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
    public function getOnlineUsers()
    {
        $stmt = $this->db->prepare("SELECT id, name, profile_image FROM users WHERE status = 'online'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk memuat model ChatModel
    protected function model($model)
    {
        require_once './app/models/' . $model . '.php';
        return new $model;
    }
}

// Menyiapkan server WebSocket di port 8080
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    8080
);

echo "WebSocket server started on ws://localhost:8080\n";
$server->run();
