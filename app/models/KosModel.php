<?php

class KosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function Data($id)
    {
        $query = "SELECT * FROM kos WHERE id_kos=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function getData($id)
    {
        $query = "SELECT kos.*, kamar.harga_bulan, kamar.harga_hari, kamar.harga_minggu, kamar.id_kamar FROM kos JOIN kamar ON kos.id_kos = kamar.id_kos where kos.id_kos = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getDataAll()
    {
        $query = "SELECT 
        kos.id_kos, 
        kos.nama_kos, 
        kos.alamat, 
        kos.tipe_kos, 
        kamar.harga_bulan AS harga, 
        (SELECT gambar.deskripsi 
         FROM gambar 
         WHERE gambar.id_kos = kos.id_kos 
         LIMIT 1) AS gambar, 
        AVG(ulasan.rating) AS avg_rating, 
        kos.waktu_penyewaan, 
        kos.tipe_kos, 
        COUNT(penyewaan.id_penyewaan) AS total_pemesanan
    FROM 
        kos
    LEFT JOIN 
        ulasan ON kos.id_kos = ulasan.id_kos
    LEFT JOIN 
        kamar ON kos.id_kos = kamar.id_kos
    LEFT JOIN 
        gambar ON kos.id_kos = gambar.id_kos
         JOIN 
        penyewaan ON kos.id_kos = penyewaan.id_kos
    GROUP BY 
        kos.id_kos, kos.tipe_kos
    ORDER BY 
        total_pemesanan DESC;
    ";

        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getAllKos($lokasi, $hargaawal, $hargaakhir)
    {
        $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan AS harga, (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) AS review_count, k.waktu_penyewaan, k.tipe_kos FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos LEFT JOIN kamar km ON k.id_kos = km.id_kos LEFT JOIN gambar g ON k.id_kos = g.id_kos WHERE k.alamat like '%$lokasi%'  AND (km.harga_bulan BETWEEN $hargaawal AND $hargaakhir OR km.harga_minggu BETWEEN $hargaawal AND $hargaakhir OR km.harga_hari BETWEEN $hargaawal AND $hargaakhir) GROUP BY k.id_kos, k.tipe_kos ORDER BY review_count DESC";
        // var_dump($query);
        // die();
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getDataBest()
    {
        $query = "SELECT 
    kos.id_kos, 
    kos.nama_kos, 
    kos.alamat, 
    kos.tipe_kos, 
    kamar.harga_bulan AS harga, 
    (SELECT gambar.deskripsi 
     FROM gambar 
     WHERE gambar.id_kos = kos.id_kos 
     LIMIT 1) AS gambar, 
    AVG(ulasan.rating) AS avg_rating, 
    kos.waktu_penyewaan, 
    kos.tipe_kos, 
    COUNT(penyewaan.id_penyewaan) AS total_pemesanan
FROM 
    kos
LEFT JOIN 
    ulasan ON kos.id_kos = ulasan.id_kos
LEFT JOIN 
    kamar ON kos.id_kos = kamar.id_kos
LEFT JOIN 
    gambar ON kos.id_kos = gambar.id_kos
     JOIN 
    penyewaan ON kos.id_kos = penyewaan.id_kos
GROUP BY 
    kos.id_kos, kos.tipe_kos
ORDER BY 
    total_pemesanan DESC;
";

        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getDataTerdekat()
    {
        $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan AS harga, (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) AS review_count, k.waktu_penyewaan, k.tipe_kos FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos LEFT JOIN kamar km ON k.id_kos = km.id_kos LEFT JOIN gambar g ON k.id_kos = g.id_kos GROUP BY k.id_kos, k.tipe_kos ORDER BY review_count DESC";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahDataKos($data)
    {
        try {
            $query = "UPDATE kos 
                      SET nama_kos = :nama_kos, 
                          deskripsi = :deskripsi, 
                          tipe_kos = :tipe_kos, 
                          peraturan_kos = :peraturan_kos, 
                          jenis_fasilitas = :jenis_fasilitas, 
                          waktu_penyewaan = :waktu_penyewaan, 
                          alamat = :alamat, 
                          latitude = :latitude, 
                          longitude = :longitude 
                      WHERE id_kos = :id_kos";

            $this->db->query($query);
            $this->db->bind('nama_kos', $data['nama_kos']);
            $this->db->bind('deskripsi', $data['deskripsi']);
            $this->db->bind('tipe_kos', $data['tipe_kos']);
            $this->db->bind('peraturan_kos', $data['peraturan_kos']);
            $this->db->bind('jenis_fasilitas', $data['jenis_fasilitas']);
            $this->db->bind('waktu_penyewaan', $data['waktu_penyewaan']);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('latitude', $data['latitude']);
            $this->db->bind('longitude', $data['longitude']);
            $this->db->bind('id_kos', $data['id_kos']);

            $this->db->execute();

            return $this->db->rowCount();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function generateKamarId()
    {

        $dateTime = date('Ym');
        $randomNumber = str_pad(rand(0, 999), 4, '0', STR_PAD_LEFT);

        return $dateTime . $randomNumber;
    }

    public function tambahDataKamar($data)
    {
        try {

            $query2 = "UPDATE kamar SET
                luas_kamar = :luas_kamar,
                jenis_fasilitas = :jenis_fasilitas,
                harga_bulan = :harga_bulan,     
                tipe_kamar = :tipe_kamar,
                kamar_tersedia = :kamar_tersedia,
                total_kamar = :total_kamar,
                harga_minggu = :harga_minggu,    
                harga_hari = :harga_hari
                WHERE id_kos = :id_kos       
            ";

            $this->db->query($query2);

            $this->db->bind('luas_kamar', $data['luas_kamar']);
            $this->db->bind('jenis_fasilitas', $data['jenis_fasilitas']);
            $this->db->bind('harga_bulan', $data['harga_bulan']);
            $this->db->bind('tipe_kamar', $data['tipe_kamar']);
            $this->db->bind('kamar_tersedia', $data['kamar_tersedia']);
            $this->db->bind('total_kamar', $data['total_kamar']);
            $this->db->bind('harga_minggu', $data['harga_minggu']);
            $this->db->bind('harga_hari', $data['harga_hari']);
            $this->db->bind('id_kos', $data['id_kos']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    public function cekIdTransaksi($id)
    {
        //isi query buat check ID Transaksi
    }

    public function CariKos($alamat, $harga)
    {
        $array = explode('-', $harga);

        $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu ,(SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos LEFT JOIN kamar km ON k.id_kos = km.id_kos 
            LEFT JOIN gambar g ON k.id_kos = g.id_kos 
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif' ";


        $conditions = [];
        if (!empty($alamat)) {
            $conditions[] = "k.alamat LIKE :alamat";
        }
        if (!empty($harga)) {
            $conditions[] = "(km.harga_bulan BETWEEN :hargaAwal AND :hargaAkhir 
        OR km.harga_minggu BETWEEN :hargaAwal AND :hargaAkhir
        OR km.harga_hari BETWEEN :hargaAwal AND :hargaAkhir)";
        }

        if (!empty($conditions)) {
            $query .= "AND " . implode(" AND ", $conditions) . " ";
        }
        $query .= "GROUP BY k.id_kos ORDER BY review_count DESC";


        $this->db->query($query);

        if (!empty($alamat)) {
            $this->db->bind('alamat', '%' . $alamat . '%');
        }
        if (!empty($harga)) {
            $this->db->bind('hargaAwal', intval($array[0]));
            $this->db->bind('hargaAkhir', intval($array[1]));
        }

        return $this->db->resultSet();
    }

    public function CariKosByFilter($lokasi, $harga, $urutan)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu ,(SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos LEFT JOIN kamar km ON k.id_kos = km.id_kos 
            LEFT JOIN gambar g ON k.id_kos = g.id_kos 
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif'";

            if (!empty($lokasi)) {
                $query .= " AND k.alamat LIKE :alamat";
            }

            // Add sorting logic
            $query .= " GROUP BY k.id_kos ORDER BY ";
            if ($urutan === "popularity") {
                $query .= "review_count DESC, ";
            }
            if ($harga === "high-to-low") {
                $query .= "COALESCE(km.harga_bulan, km.harga_minggu, km.harga_hari) DESC, ";
            } elseif ($harga === "low-to-high") {
                $query .= "COALESCE(km.harga_bulan, km.harga_minggu, km.harga_hari) ASC, ";
            }
            $query .= "avg_rating DESC";

            $this->db->query($query);

            // Bind location parameter if applicable
            if (!empty($lokasi)) {
                $this->db->bind('alamat', '%' . $lokasi . '%');
            }

            $results = $this->db->resultSet();
            return $results;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getDataKamar($id)
    {
        $query = "SELECT kos.waktu_penyewaan AS waktu_sewa, kamar.* FROM kos JOIN kamar ON kos.id_kos=kamar.id_kos WHERE kos.id_kos=:id_kos";

        $this->db->query($query);
        $this->db->bind('id_kos', $id);

        return $this->db->single();
    }

    public function jumlahPenyewa()
    {
        $query = "SELECT COUNT(DISTINCT id_user) AS jumlah FROM penyewaan WHERE id_kos=:id";

        $this->db->query($query);
        $this->db->bind('id', $_SESSION['user']['id_kos']);

        return $this->db->single();
    }

    public function totalRating()
    {
        $query = "SELECT COUNT(*) AS user, SUM(rating) AS rating FROM ulasan WHERE id_kos=:id";

        $this->db->query($query);
        $this->db->bind('id', $_SESSION['user']['id_kos']);

        return $this->db->single();
    }
}
