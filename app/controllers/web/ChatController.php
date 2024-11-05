<?php
session_start();
include_once "config.php";

class ChatController extends Controller
{
    private $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    public function index()
    {
        $this->view('detail/chats');
    }

    // Ensure the user is authenticated
    public function authenticateUser()
    {
        if (!isset($_SESSION['id_user'])) {
            header("location: login.php");
            exit();
        }
    }

    // Retrieve user data based on id_user
    public function getUserById($user_id)
    {
        $user_id = mysqli_real_escape_string($this->conn, $user_id);
        $sql = "SELECT * FROM rekost_user WHERE id_user = {$user_id}";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            header("location: users.php");
            exit();
        }
    }

    // Retrieve chat list for a specific user
    public function getChatList($user_id)
    {
        $sql = "SELECT * FROM rekost_chat_message WHERE id_sender = {$user_id} OR id_receiver = {$user_id} ORDER BY waktu_kirim_pesan DESC";
        $result = mysqli_query($this->conn, $sql);

        $chats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $chats[] = $row;
        }
        return $chats;
    }

    // Send a message
    public function sendMessage($incoming_id, $outgoing_id, $message)
    {
        $message = mysqli_real_escape_string($this->conn, $message);
        $sql = "INSERT INTO rekost_chat_message (id_sender, id_receiver, message, waktu_kirim_pesan) VALUES ('$outgoing_id', '$incoming_id', '$message', NOW())";
        return mysqli_query($this->conn, $sql);
    }

    // Retrieve messages between two users
    public function getMessages($user1, $user2)
    {
        $sql = "SELECT * FROM rekost_chat_message WHERE 
                (id_sender = '$user1' AND id_receiver = '$user2') 
                OR (id_sender = '$user2' AND id_receiver = '$user1') 
                ORDER BY waktu_kirim_pesan ASC";
        $result = mysqli_query($this->conn, $sql);

        $messages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        return $messages;
    }
}

// Initialize and use the controller
$chatController = new ChatController($conn);
$chatController->authenticateUser();

if (isset($_GET['user_id'])) {
    $user = $chatController->getUserById($_GET['user_id']);
    $chatList = $chatController->getChatList($_SESSION['id_user']);
} else {
    header("location: users.php");
    exit();
}

// Fetch messages (can be called with AJAX to dynamically update messages)
if (isset($_POST['action']) && $_POST['action'] == 'fetchMessages') {
    $messages = $chatController->getMessages($_SESSION['id_user'], $_POST['incoming_id']);
    echo json_encode($messages);
    exit();
}

// Send message (can also be called with AJAX to send messages without reloading)
if (isset($_POST['action']) && $_POST['action'] == 'sendMessage') {
    $chatController->sendMessage($_POST['incoming_id'], $_SESSION['id_user'], $_POST['message']);
    exit();
}
