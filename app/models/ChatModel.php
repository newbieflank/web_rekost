<?php
require_once './app/core/Database.php';

class ChatModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function chats($idUser)
    {
        // var_dump($this->_SESSION);
        // die;
        // Use session ID for user validation
        $user_id = $_SESSION['user']['id_user'];
        $sql = "SELECT id_user, nama, id_gambar FROM user WHERE status_user = 'online' AND id_user <> :id_user";

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
WHERE (chat_message.id_sender = :id_sender AND chat_message.id_receiver = :id_receiver)
   OR (chat_message.id_sender = :id_receiver AND chat_message.id_receiver = :id_sender)
ORDER BY chat_message.waktu_kirim_pesan ASC";

        // Menyiapkan query dan mengikat nilai parameter
        $this->db->query($sql);
        $this->db->bind(':id_sender', $incoming_id);
        $this->db->bind(':id_receiver', $outgoing_id);

        // Menjalankan query dan mengembalikan hasilnya
        $messages = $this->db->resultSet();


        return $messages;
    }



    public function sendMessage($data)

    {
        if (!empty($data['id_receiver']) && !empty($data['message']) && !empty($data['id_sender'])) {
            $sql = "INSERT INTO chat_message (id_receiver, id_sender, message) 
                    VALUES (:id_receiver, :id_sender, :message )";

            $this->db->query($sql);
            $this->db->bind('id_receiver', $data['id_receiver']);
            $this->db->bind('id_sender', $data['id_sender']);
            $this->db->bind('message', $data['message']);


            if ($this->db->execute()) {
                return true;
            } else {
                // error_log("Failed to execute query: " . $this->db->errorInfo());
                return false;
            }
        }
        return false;
    }
}
