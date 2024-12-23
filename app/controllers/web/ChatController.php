<?php


class ChatController extends Controller
{
    private $chatModel;
    private $userModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }
        // Load the ChatModel
        $this->chatModel = $this->model('ChatModel');
        $this->userModel = $this->model('UsersModel');
    }

    public function chatUser($id) {}
    public function chats()
    {
        // Fetch the online users

        $onlineUsers = $this->chatModel->chats($_SESSION["user"]["id_user"]);
        $userId = $_GET["user"] ?? null;
        $user = array_filter($onlineUsers, function ($e) use ($userId) {
            return  $e['id_user'] == $userId;
        });
        // var_dump($user);
        // die;

        if (empty($user)) {
            $user = $this->userModel->findUserById($userId);
        } else {
            $user = reset($user);
        }

        $layoutData = [
            'onlineUsers' => $onlineUsers,  // Corrected the array structure
            'user' => $user,
        ];

        // Render the view and pass the data
        $this->view('detail/chats', $layoutData);
    }
    public function get_chat($userId)
    {

        $outgoing_id = $_SESSION['user']['id_user'];
        // Call get_chat method from ChatModel
        $messages = $this->chatModel->get_chat($userId, $outgoing_id);

        if ($messages) {
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No messages available']);
        }
    }
    public function sendMessage($incomingUserId)
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');


            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_sender' => $_SESSION['user']['id_user'],
                'id_receiver' => $incomingUserId,
                'message' => trim($_POST['message']),

            ];

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

    public function chats2()
    {
        $onlineUsers = $this->chatModel->chats($_SESSION["user"]["id_user"]);


        $layoutData = [
            'onlineUsers' => $onlineUsers,  // Corrected the array structure
            'user' => $_SESSION['user']     // Example: passing user data if needed
        ];

        $this->view('detail/chats', $layoutData);
    }
}
