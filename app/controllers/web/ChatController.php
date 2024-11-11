<?php
// Mulai sesi hanya jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "/../../../config/config.php";

class ChatController extends Controller
{
    private $conn;

    // Konstruktor menerima objek koneksi dan menyimpannya ke properti $conn
    public function __construct($Conn)
    {
        $this->conn = $Conn;
    }

    // Metode untuk mendapatkan daftar pengguna online
    public function chats()
    {   
        $user_id = $_SESSION['user']['id_user'];
        $sql = "SELECT id_user, nama FROM user WHERE status1 = 'online' AND id_user != :id_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $onlineUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($onlineUsers)) {
            $onlineUsers = []; // Set data kosong jika tidak ada pengguna online
        }

        // Panggil tampilan dengan data pengguna online
        $this->view('detail/chats', ['onlineUsers' => $onlineUsers]);
    }

    // Metode untuk mendapatkan chat berdasarkan user_id
    public function getChatByUserId($user_id)
    {
        if ($user_id) {
            // Query untuk mengambil data chat berdasarkan user_id
            $sql = "SELECT message, sent_by_user, time FROM chat_message WHERE id_user = :id_user ORDER BY time ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mengembalikan hasil dalam format JSON
            echo json_encode($chats);
        } else {
            // Jika user_id tidak ada, return JSON kosong
            echo json_encode([]);
        }
    }

    // Metode untuk mengirim pesan
    public function sendMessage()
    {
        // Pastikan sesi dimulai dan pengguna sudah login
        if (isset($_SESSION['id_user'])) {
            $outgoing_id = $_SESSION['id_user']; // ID pengguna yang mengirim pesan
            $incoming_id = mysqli_real_escape_string($this->conn, $_POST['incoming_id']);
            $message = mysqli_real_escape_string($this->conn, $_POST['message']);

            // Cek jika pesan tidak kosong
            if (!empty($message)) {
                $sql = "INSERT INTO chat_message (id_user, sent_by_user, msg) 
                        VALUES (:incoming_id, :outgoing_id, :message)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
                $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
                $stmt->bindParam(':message', $message, PDO::PARAM_STR);
                $stmt->execute();

                // Setelah pesan dikirim, bisa memberi respons berupa status sukses
                echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
            }
        } else {
            // Pengguna belum login
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        }
    }
}
?>
