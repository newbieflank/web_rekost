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

    public function getNotifikasiPemilik($id_user)
    {
        $query = "
                SELECT 
                p.id_penyewaan,
                p.tanggal_penyewaan,
                p.waktu_penyewaan,
                p.durasi,
                p.harga,
                p.status_penyewaan,
                DATEDIFF(DATE_ADD(p.tanggal_penyewaan, INTERVAL p.durasi DAY), CURDATE()) AS sisa_hari,
                u.nama AS nama_penyewa,
                k.nama_kos
                FROM 
                penyewaan p
                JOIN user u ON p.id_user = u.id_user
                JOIN kos k ON p.id_kos = k.id_kos
                WHERE 
                k.id_user = :id_user
                AND (
                    DATEDIFF(DATE_ADD(p.tanggal_penyewaan, INTERVAL p.durasi DAY), CURDATE()) <= 3
                    OR p.status_penyewaan = 'Tersedia'
                )
                AND DATEDIFF(CURDATE(), p.tanggal_penyewaan) <= 60
        ";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    
    
    



}