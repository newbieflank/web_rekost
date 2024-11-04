<?php
session_start();
include_once "config.php";

class ChatController
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    // Memastikan pengguna telah login
    public function authenticateUser()
    {
        if (!isset($_SESSION['unique_id'])) {
            header("location: login.php");
            exit();
        }
    }

    // Mendapatkan data pengguna berdasarkan unique_id
    public function getUserById($user_id)
    {
        $user_id = mysqli_real_escape_string($this->conn, $user_id);
        $sql = "SELECT * FROM users WHERE unique_id = {$user_id}";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            header("location: users.php");
            exit();
        }
    }

    // Mendapatkan daftar chat yang dimiliki pengguna
    public function getChatList($unique_id)
    {
        $sql = "SELECT * FROM chats WHERE user_id = {$unique_id} ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $sql);

        $chats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $chats[] = $row;
        }
        return $chats;
    }

    // Mengirimkan pesan
    public function sendMessage($incoming_id, $outgoing_id, $message)
    {
        $message = mysqli_real_escape_string($this->conn, $message);
        $sql = "INSERT INTO messages (incoming_id, outgoing_id, message) VALUES ('$incoming_id', '$outgoing_id', '$message')";
        return mysqli_query($this->conn, $sql);
    }

    // Mendapatkan pesan antara dua pengguna
    public function getMessages($user1, $user2)
    {
        $sql = "SELECT * FROM messages WHERE 
                (incoming_id = '$user1' AND outgoing_id = '$user2') 
                OR (incoming_id = '$user2' AND outgoing_id = '$user1') 
                ORDER BY created_at ASC";
        $result = mysqli_query($this->conn, $sql);

        $messages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        return $messages;
    }
}

// Inisialisasi dan penggunaan controller
$chatController = new ChatController($conn);
$chatController->authenticateUser();

if (isset($_GET['user_id'])) {
    $user = $chatController->getUserById($_GET['user_id']);
    $chatList = $chatController->getChatList($_SESSION['unique_id']);
} else {
    header("location: users.php");
    exit();
}

// Menampilkan pesan (fungsi ini bisa dipanggil dengan AJAX untuk memperbarui pesan secara dinamis)
if (isset($_POST['action']) && $_POST['action'] == 'fetchMessages') {
    $messages = $chatController->getMessages($_SESSION['unique_id'], $_POST['incoming_id']);
    echo json_encode($messages);
    exit();
}

// Mengirim pesan (fungsi ini juga bisa dipanggil dengan AJAX untuk mengirim pesan tanpa reload)
if (isset($_POST['action']) && $_POST['action'] == 'sendMessage') {
    $chatController->sendMessage($_POST['incoming_id'], $_SESSION['unique_id'], $_POST['message']);
    exit();
}
?>
