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
        $query = "
            SELECT 
                p.id_penyewaan,
                p.tanggal_penyewaan,
                p.waktu_penyewaan,
                p.durasi,
                p.harga,
                p.status_penyewaan,
                DATEDIFF(DATE_ADD(p.tanggal_penyewaan, INTERVAL p.durasi DAY), CURDATE()) AS sisa_hari
            FROM 
                penyewaan p
            WHERE 
                p.status_penyewaan = 'Tersedia'
                AND DATEDIFF(DATE_ADD(p.tanggal_penyewaan, INTERVAL p.durasi DAY), CURDATE()) <= 3
                AND DATEDIFF(DATE_ADD(p.tanggal_penyewaan, INTERVAL p.durasi DAY), CURDATE()) >= 0
                AND p.id_user = :id_user;
        ";
    
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    



}