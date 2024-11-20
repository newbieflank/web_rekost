<?php
require 'vendor/autoload.php'; // Pastikan path ke Composer autoload benar

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Ambil parameter id_user dari URL query string
        $queryParams = [];
        parse_str($conn->httpRequest->getUri()->getQuery(), $queryParams);
var_dump($this->$queryParams);
die;
        // Simpan id_user ke dalam koneksi
        if (isset($queryParams['id_user'])) {
            $conn->userId = $queryParams['id_user']; // Menyimpan id_user di dalam objek koneksi
            echo "New connection! (UserID: {$conn->id_user}, Resource ID: {$conn->id_receiver})\n";
        } else {
            echo "Connection attempt without user ID.\n";
        }

        // Menyimpan koneksi pengguna
        $this->clients->attach($conn);
    }

    public function onClose(ConnectionInterface $conn) {
        // Menghapus koneksi ketika client menutup koneksi
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Menangani pesan yang dikirim dari client
        $data = json_decode($msg, true);

        if (isset($data['message']) && isset($data['id_receiver'])) {
            $senderId = isset($data['id_sender']) ? $data['id_sender'] : null;
            $receiverId = $data['id_receiver'];
            $message = $data['message'];

            // Kirim pesan ke penerima (hanya jika mereka terhubung)
            foreach ($this->clients as $client) {
                // Hanya kirim ke penerima yang sesuai
                if ($client !== $from && isset($client->userId) && $client->userId == $receiverId) {
                    $responseMessage = json_encode([
                        'type' => 'message',
                        'id' => uniqid(), // ID pesan unik
                        'message' => $message,
                        'sender_id' => $senderId,
                        'receiver_id' => $receiverId,
                        'time' => date('H:i'),
                        'sent_by_user' => true // Tandai pesan dikirim oleh pengguna
                    ]);
                    $client->send($responseMessage); // Kirim pesan ke penerima
                }
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Membuat server WebSocket dan mendengarkan di port 8080
$server = new Ratchet\App('localhost', 8080);
$server->route('/chat', new ChatServer, ['*']);
$server->run();
?>
