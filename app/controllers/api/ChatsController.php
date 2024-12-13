<?php

class ChatsController extends Controller
{

    private $chat;

    public function __construct()
    {
        $this->chat = $this->model('ChatModel');
    }


    public function listChats($id_sender)
    {
        $onlineUsers = $this->chat->chats($id_sender);
        echo json_encode(['status' => 'success', 'data' => $onlineUsers]);
    }

    public function chatDetail($id_sender, $id_receiver)
    {
        $messages = $this->chat->get_chat($id_sender, $id_receiver);

        if ($messages) {
            echo json_encode(['status' => 'success', 'data' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No messages available']);
        }
    }

    public function sendMessage($id_sender, $id_receiver)
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');


            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id_sender' => $id_sender,
                'id_receiver' => $id_receiver,
                'message' => trim($_POST['message']),

            ];

            // error_log(print_r($data, true));

            // Panggil fungsi sendMessage di ChatModel
            if ($this->chat->sendMessage($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim', "data" => ["message" => "Dsa"]]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Request tidak valid']);
        }
    }
}
