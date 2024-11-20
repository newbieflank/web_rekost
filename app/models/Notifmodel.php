<?php

class Notifmodel
{
    private $table = 'pembayaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getNotifikasi($id_user)
    {
        $query = "SELECT p.*, py.id_user 
                  FROM pembayaran p
                  JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan
                  WHERE py.id_user = :id_user 
                  AND p.status_pembayaran = 'Dibayar'
                  AND p.tanggal_pembayaran >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                  ORDER BY p.tanggal_pembayaran DESC
                  LIMIT 5";

        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function getUnreadCount($id_user)
    {
        $query = "SELECT COUNT(*) as count 
                  FROM pembayaran p
                  JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan
                  WHERE py.id_user = :id_user 
                  AND p.status_pembayaran = 'Dibayar'
                  AND p.tanggal_pembayaran >= DATE_SUB(NOW(), INTERVAL 1 DAY)";

        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $result = $this->db->single();
        return $result['count'];
    }
}