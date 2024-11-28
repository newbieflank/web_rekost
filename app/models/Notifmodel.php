<?php

class Notifmodel
{
    private $table = 'pembayaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getNotif312ikasi($id_user)
    // {
    //     $query = "SELECT p.*, py.*, 
    //               DATEDIFF(DATE_ADD(py.tanggal_penyewaan, 
    //                 INTERVAL CASE py.waktu_penyewaan
    //                     WHEN 'harian' THEN durasi
    //                     WHEN 'mingguan' THEN durasi * 7 
    //                 END DAY), CURRENT_DATE) as sisa_hari
    //               FROM pembayaran p
    //               JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan 
    //               WHERE py.id_user = :id_user AND p.status_pembayaran = 'Dibayar'";

    //     $this->db->query($query);
    //     $this->db->bind('id_user', $id_user);
    //     $result = $this->db->resultSet();
    //     return $result;
    // }

    // public function getNotifikasi($id_user) {
//     $query = "SELECT * FROM pembayaran p 
//               JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan
//               WHERE py.id_user = :id_user";

    //     $this->db->query($query);
//     $this->db->bind('id_user', $id_user);
//     $result = $this->db->resultSet();
//     var_dump($result); // Debug
//     return $result;
// }

    // public function getNotifikasi($id_user) {
//     $query = "SELECT p.*, py.*,
//         DATEDIFF(DATE_ADD(py.tanggal_penyewaan, 
//             INTERVAL (CASE py.waktu_penyewaan
//                 WHEN 'harian' THEN py.durasi
//                 WHEN 'mingguan' THEN py.durasi * 7
//                 WHEN '1 bulan' THEN py.durasi * 30
//                 WHEN '3 bulan' THEN py.durasi * 90 
//                 WHEN '6 bulan' THEN py.durasi * 180
//                 WHEN 'tahunan' THEN py.durasi * 365
//             END) DAY), CURRENT_DATE) as sisa_hari
//         FROM pembayaran p
//         JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan
//         WHERE py.id_user = :id_user 
//         AND (p.status_pembayaran = 'Dibayar' 
//             OR sisa_hari <= 3)
//         ORDER BY p.tanggal_pembayaran DESC, sisa_hari ASC
//         LIMIT 5";

    //     $this->db->query($query);
//     $this->db->bind('id_user', $id_user);
//     return $this->db->resultSet();
// }

    public function getNotifikasi($id_user)
    {
        $query = "SELECT 
            p.*, py.id_user,
            py.tanggal_penyewaan,
            py.durasi,
            py.waktu_penyewaan,
            DATE_ADD(py.tanggal_penyewaan, 
                INTERVAL CASE py.waktu_penyewaan
                    WHEN 'harian' THEN py.durasi
                    WHEN 'mingguan' THEN py.durasi * 7
                    WHEN '1 bulan' THEN py.durasi * 30
                    WHEN '3 bulan' THEN py.durasi * 90
                    WHEN '6 bulan' THEN py.durasi * 180
                    WHEN 'tahunan' THEN py.durasi * 365
                END DAY) as tanggal_berakhir
            FROM pembayaran p
            JOIN penyewaan py ON p.id_penyewaan = py.id_penyewaan 
            WHERE py.id_user = :id_user 
            AND (
                (p.status_pembayaran = 'Dibayar' AND p.tanggal_pembayaran >= DATE_SUB(NOW(), INTERVAL 7 DAY))
                OR 
                (DATEDIFF(DATE_ADD(py.tanggal_penyewaan, 
                    INTERVAL CASE py.waktu_penyewaan
                        WHEN 'harian' THEN py.durasi
                        WHEN 'mingguan' THEN py.durasi * 7
                        WHEN '1 bulan' THEN py.durasi * 30
                        WHEN '3 bulan' THEN py.durasi * 90
                        WHEN '6 bulan' THEN py.durasi * 180
                        WHEN 'tahunan' THEN py.durasi * 365
                    END DAY), CURRENT_DATE) <= 3
                AND DATEDIFF(DATE_ADD(py.tanggal_penyewaan, 
                    INTERVAL CASE py.waktu_penyewaan
                        WHEN 'harian' THEN py.durasi
                        WHEN 'mingguan' THEN py.durasi * 7
                        WHEN '1 bulan' THEN py.durasi * 30
                        WHEN '3 bulan' THEN py.durasi * 90
                        WHEN '6 bulan' THEN py.durasi * 180
                        WHEN 'tahunan' THEN py.durasi * 365
                    END DAY), CURRENT_DATE) >= 0)
            )
            ORDER BY p.tanggal_pembayaran DESC, tanggal_berakhir ASC
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