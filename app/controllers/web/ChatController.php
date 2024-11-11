<?php

class ChatController extends Controller{
    private $chatModel;
    public function __construct() {
        $this->chatModel =  $this->model('ChatModel');
    }
public function chats()
{
   
    echo json_encode($this->chatModel->chats($_SESSION["user"]["id_user"]));
}}