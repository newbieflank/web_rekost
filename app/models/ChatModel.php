<?php

class ChatModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function chats($idUser)
    {   
        // Use session ID for user validation
        $user_id = $_SESSION['user']['id_user'];
        $sql = "SELECT id_user, nama FROM user WHERE status_user = 'online' AND id_user != :id_user";
        
        $this->db->query($sql);
        $this->db->bind('id_user', $user_id);
        
        return $this->db->resultSet();
    }

    public function get_chat($incoming_id, $outgoing_id)
{
    // Query SQL untuk mengambil semua pesan antara dua pengguna (dua arah)
    $sql = "SELECT chat_message.message, 
                   chat_message.id_sender, 
                   chat_message.waktu_kirim_pesan AS time
            FROM chat_message
            LEFT JOIN user ON user.id_user = chat_message.id_sender
            WHERE (chat_message.id_sender = :incoming_id AND chat_message.id_receiver = :outgoing_id)
               OR (chat_message.id_sender = :outgoing_id AND chat_message.id_receiver = :incoming_id)
            ORDER BY chat_message.waktu_kirim_pesan ASC";

    // Menyiapkan query dan mengikat nilai parameter
    $this->db->query($sql);
    $this->db->bind(':incoming_id', $incoming_id);
    $this->db->bind(':outgoing_id', $outgoing_id);

    // Menjalankan query dan mengembalikan hasilnya
    $messages = $this->db->resultSet();
    return $messages;
}


    // Method to send a message
    public function sendMessage($data)
    {
        if (!empty($data['id_receiver']) && !empty($data['message']) && !empty($data['id_sender'])) {
            $sql = "INSERT INTO chat_message (id_receiver, id_sender, message) 
                    VALUES (:id_receiver, :id_sender, :message )";
            
            $this->db->query($sql);
            $this->db->bind('id_receiver', $data['id_receiver']);
            $this->db->bind('id_sender', $data['id_sender']);
            $this->db->bind('message', $data['message']);
            // $this->db->bind('waktu_kirim_pesan', $data['waktu_kirim_pesan']);

            if ($this->db->execute()) {
                return true;
            } else {
                error_log("Failed to execute query: " . $this->db->errorInfo());
                return false;
            }
        }
        return false;
    }
}
