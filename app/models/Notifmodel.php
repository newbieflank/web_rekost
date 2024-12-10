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
        $query = "SELECT 
        p.*, py.id_user, py.tanggal_penyewaan, py.durasi, py.waktu_penyewaan,
        CASE py.waktu_penyewaan
            WHEN 'harian' THEN py.durasi
            WHEN 'mingguan' THEN py.durasi * 1
            WHEN '1 bulan' THEN py.durasi * 1
            WHEN '3 bulan' THEN py.durasi * 1
            WHEN '6 bulan' THEN py.durasi * 1
            WHEN 'tahunan' THEN py.durasi * 1
        END as total_hari,
        DATEDIFF(
            DATE_ADD(py.tanggal_penyewaan, 
            INTERVAL CASE py.waktu_penyewaan
                WHEN 'harian' THEN py.durasi
                WHEN 'mingguan' THEN py.durasi * 1 
                WHEN '1 bulan' THEN py.durasi * 1
                WHEN '3 bulan' THEN py.durasi * 1
                WHEN '6 bulan' THEN py.durasi * 1
                WHEN 'tahunan' THEN py.durasi * 1
            END DAY), 
            CURRENT_DATE
        ) as sisa_hari
        FROM pembayaran p
        JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan 
        WHERE py.id_user = :id_user 
        AND (
            (p.status_pembayaran = 'Dibayar' AND p.tanggal_pembayaran >= DATE_SUB(NOW(), INTERVAL 45 DAY))
            OR 
            DATEDIFF(
                DATE_ADD(py.tanggal_penyewaan, 
                INTERVAL CASE py.waktu_penyewaan
                    WHEN 'harian' THEN py.durasi
                    WHEN 'mingguan' THEN py.durasi * 1
                    WHEN '1 bulan' THEN py.durasi * 1
                    WHEN '3 bulan' THEN py.durasi * 1
                    WHEN '6 bulan' THEN py.durasi * 1
                    WHEN 'tahunan' THEN py.durasi * 1
                END DAY),
                CURRENT_DATE
            ) <= 3
        )
        ORDER BY p.tanggal_pembayaran DESC, sisa_hari ASC
        LIMIT 10";

        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }



}