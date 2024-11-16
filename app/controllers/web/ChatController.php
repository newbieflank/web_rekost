<?php

class ChatController extends Controller {
    private $chatModel;

    public function __construct() {
        // Load the ChatModel
        $this->chatModel = $this->model('ChatModel');
    }

    public function chats() {
        // Fetch the online users
        $onlineUsers = $this->chatModel->chats($_SESSION["user"]["id_user"]);

        // Prepare layout data to pass to the view
        $layoutData = [
            'onlineUsers' => $onlineUsers,  // Corrected the array structure
            'user' => $_SESSION['user']     // Example: passing user data if needed
        ];

        // Render the view and pass the data
        $this->view('detail/chats', $layoutData);
    }
    public function get_chat($userId) {
        echo json_encode(['status' => 'success']);
        die;
       
        $outgoing_id = $_SESSION['user']['id_user'];
        
        // Call get_chat method from ChatModel
        $messages = $this->chatModel->get_chat($userId, $outgoing_id);
      
        // Return the messages as JSON if needed or pass to view
        if ($messages) {
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No messages available']);
        }
    }
    public function sendMessage($receiverId) {

      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $data = [
                'id_receiver' => trim($_POST['id_receiver']),
                'id_sender' => $_SESSION['user']['id_user'],
                'message' => trim($_POST['message']),
               
            ];
            // echo json_encode(['status' => 'success']);
            // die;
    
            // Log data untuk memverifikasi apakah sudah benar
            error_log(print_r($data, true));
    
            // Panggil fungsi sendMessage di ChatModel
            if ($this->chatModel->sendMessage($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Request tidak valid']);
        }
    }
    public function execute() {
        if ($this->stmt->execute()) {
            return true;
        } else {
            // Tangkap dan log error MySQL
            $error = $this->stmt->errorInfo();
            error_log("Error Database: " . print_r($error, true));
            return false;
        }
    }
    
}    