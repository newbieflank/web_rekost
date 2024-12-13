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
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No messages available']);
        }
    }
}
