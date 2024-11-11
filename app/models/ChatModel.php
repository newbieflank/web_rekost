<?php

class ChatModel  {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function chats($idUser)
    {   
        $user_id = $_SESSION['user']['id_user'];
        $sql = "SELECT id_user, nama FROM user WHERE status1 = 'online' AND id_user != :id_user";
        $this->db->query($sql);
        $this->db->bind('id_user', $idUser);
        $this->db->execute();

        return $this->db->resultSet() ;
    }

    // Metode untuk mendapatkan chat berdasarkan user_id
    public function get_chat($user_id)
{
    
    if ($user_id) {
        // Query untuk mengambil data chat berdasarkan user_id
        $sql = "SELECT msg AS message, id_user AS sent_by_user, waktu_kirim_pesan AS time FROM chat_message WHERE incoming_msg_id = :id_user ORDER BY waktu_kirim_pesan ASC;";
        $this->db->query($sql);
        $this->db->bind('msg', $data['msg']);
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('waktu_kirim_pesan', $data['waktu_kirim_pesan']);
        $this->db->bind('incoming_msg_id', $data['incoming_msg_id']);
        $this->db->execute();
        return $this->db->rowCount();
    } else {
        // Jika user_id tidak ada, return JSON kosong
        echo json_encode([]);
    }
}

    // Metode untuk mengirim pesan
    public function sendMessage()
    {
        // Pastikan sesi dimulai dan pengguna sudah logi  // Pesan yang dikirim
            if (!empty($incoming_id) && !empty($message)) {
                $sql = "INSERT INTO chat_message (incoming_msg_id, outgoing_msg_id, msg) VALUES (:incoming_id, :outgoing_id, :message)";
                $this->db->query($sql);
                $this->db->bind('incoming_msg_id', $data['incoming_msg_id']);
                $this->db->bind('outgoing_msg_id', $data['outgoing_msg_id']);
                $this->db->bind('msg', $data['waktu_kirim_pesan']);
                $this->db->bind('incoming_msg_id', $data['incoming_msg_id']);
                $this->db->execute();
                return $this->db->rowCount();
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Pesan atau ID tidak valid']);
            }
    
}  }


