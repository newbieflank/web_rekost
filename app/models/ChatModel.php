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
        $sql = "SELECT user.id_user,user.nama,user.id_gambar, (SELECT message FROM chat_message where user.id_user = chat_message.id_receiver OR user.id_user = chat_message.id_sender order by id_message desc limit 1) as message,(SELECT waktu_kirim_pesan FROM chat_message where user.id_user = chat_message.id_receiver OR user.id_user = chat_message.id_sender order by id_message desc limit 1) as time
            FROM user JOIN chat_message ch ON user.id_user = ch.id_receiver OR user.id_user = ch.id_sender
            WHERE (ch.id_receiver = :id_user OR ch.id_sender = :id_user) AND user.id_user != :id_user GROUP BY user.id_user, user.nama, user.id_gambar;";
        $this->db->query($sql);
        $this->db->bind('id_user', $idUser);

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
                return false;
            }
        }

        return false;
    }
}
