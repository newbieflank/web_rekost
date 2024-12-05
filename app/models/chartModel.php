<?php
class chartModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getpendapatan()
    {
        try {
            $query = "SELECT SUM(harga) AS pendapatan FROM penyewaan WHERE id_kos= :id";

            $this->db->query($query);
            $this->db->bind('id', $_SESSION['user']['id_kos']);
            $results = $this->db->single();
            return $results;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function getpengeluaran()
    {
        try {
            $query = "SELECT 
                        jenis_transaksi,
                        SUM(jumlah) AS total_jumlah
                      FROM 
                        manajemen_pemilik
                      WHERE 
                        jenis_transaksi = 'pengeluaran'
                      GROUP BY 
                        jenis_transaksi;";

            $this->db->query($query);
            $results = $this->db->single();
            return $results;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function getUlasan()
    {
        try {
            $query = "SELECT 
    k.id_kos,
    k.nama_kos,
    u.nama AS pengulas_kos,
    u.alamat AS alamat_user, 
    ul.rating,
    ul.ulasan
FROM 
    kos k
LEFT JOIN 
    ulasan ul ON k.id_kos = ul.id_kos
LEFT JOIN 
    user u ON ul.id_user = u.id_user
WHERE 
    ul.id_ulasan IS NOT NULL
ORDER BY 
    k.id_kos, ul.tanggal_ulas DESC;
;";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (\Throwable $e) {
            echo "error" . $e->getMessage();
        }
    }

    public function getulasanatas()
    {
        try {
            $query = "SELECT 
            k.id_kos,
            k.nama_kos,
            COALESCE(AVG(ul.rating) / 5, 0) AS rata_rata_rating  
        FROM 
            kos k
        LEFT JOIN 
            ulasan ul ON k.id_kos = ul.id_kos  
        GROUP BY 
            k.id_kos, k.nama_kos  
        HAVING 
            AVG(ul.rating) IS NOT NULL  
        ORDER BY 
            rata_rata_rating DESC;";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (\Throwable $e) {
            echo "error" . $e->getMessage();
        }
    }


    public function gettransaksi($id)
    {
        try {
            $query = "SELECT MONTH(tanggal_penyewaan) AS bulan_index, SUM(harga) AS total_transaksi FROM penyewaan WHERE id_kos= :id
          GROUP BY MONTH(tanggal_penyewaan) 
          ORDER BY bulan_index;";

            $this->db->query($query);
            $this->db->bind('id', $id);
            $results = $this->db->resultSet();
            return $results;
        } catch (\Throwable $e) {
            echo "error" . $e->getMessage();
        }
    }

    public function gettransaksi2()
    {
        try {
            $query = "SELECT MONTH(tgl_transaksi) AS bulan_index, 
          SUM(jumlah) AS total_transaksi 
          FROM manajemen_pemilik 
          WHERE jenis_transaksi = 'pengeluaran' 
          GROUP BY MONTH(tgl_transaksi) 
          ORDER BY bulan_index;";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (\Throwable $e) {
            echo "error" . $e->getMessage();
        }
    }
}
