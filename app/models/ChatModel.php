<?php
class ChatModel extends CI_Model {
    
    public function getChatList($user_id) {
        $this->db->select('unique_id, name, last_message, timestamp');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('chats');
        return $query->result_array();
    }

    public function getMessages($outgoing_id, $incoming_id) {
        $this->db->where("(outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
                           OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})");
        $this->db->order_by('msg_id', 'ASC');
        $query = $this->db->get('messages');
        return $query->result_array();
    }

    public function insertMessage($outgoing_id, $incoming_id, $message) {
        $data = [
            'outgoing_msg_id' => $outgoing_id,
            'incoming_msg_id' => $incoming_id,
            'msg' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('messages', $data);
    }
}
