<?php
class CardViewModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;  // Assuming the Database class is properly defined
    }


    //VIEW POPULAR KOS
    public function SelectCardViewKosPoPular($limit = false)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu , (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan, status_user.status 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos 
            LEFT JOIN kamar km ON k.id_kos = km.id_kos LEFT JOIN gambar g ON k.id_kos = g.id_kos
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif' GROUP BY k.id_kos
            ORDER BY review_count DESC ";

            if ($limit === true) {
                $query .= "LIMIT 0, 25;";
            }

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function SelectCardViewKosPopularByFilter($lokasi, $harga)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu , (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan, status_user.status 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos 
            LEFT JOIN kamar km ON k.id_kos = km.id_kos LEFT JOIN gambar g ON k.id_kos = g.id_kos
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif'";

            if (!empty($lokasi)) {
                $query .= " AND k.alamat LIKE :alamat";
            }

            // Add sorting logic
            $query .= " GROUP BY k.id_kos ORDER BY ";

            if ($harga === "high-to-low") {
                $query .= "COALESCE(km.harga_bulan, km.harga_minggu, km.harga_hari) DESC, ";
            } elseif ($harga === "low-to-high") {
                $query .= "COALESCE(km.harga_bulan, km.harga_minggu, km.harga_hari) ASC, ";
            }
            $query .= "review_count DESC";

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


    //VIEW BEST KOS
    public function SelectCardViewKosBest($limit = false)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu ,(SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan, status_user.status 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos 
            LEFT JOIN kamar km ON k.id_kos = km.id_kos LEFT JOIN gambar g ON k.id_kos = g.id_kos 
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif'
            GROUP BY k.id_kos ORDER BY avg_rating DESC 
            ";

            if ($limit === true) {
                $query .= "LIMIT 0, 25;";
            }

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function SelectCardViewKosBestByFilter($lokasi, $harga, $urutan)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
        AS harga, km.harga_hari, km.harga_minggu, 
        (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, 
        AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) AS review_count, 
        k.waktu_penyewaan, status_user.status 
        FROM kos k 
        LEFT JOIN ulasan u ON k.id_kos = u.id_kos 
        LEFT JOIN kamar km ON k.id_kos = km.id_kos 
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



    //VIEW CAMPUS KOS
    public function SelectCardViewKosCampus($limit = false)
    {
        try {
            $query = "SELECT k.id_kos, k.nama_kos, k.alamat, k.tipe_kos, km.harga_bulan 
            AS harga, km.harga_hari, km.harga_minggu ,(SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) 
            AS gambar, AVG(u.rating) AS avg_rating, COUNT(u.id_ulasan) 
            AS review_count, k.waktu_penyewaan 
            FROM kos k LEFT JOIN ulasan u ON k.id_kos = u.id_kos LEFT JOIN kamar km ON k.id_kos = km.id_kos 
            LEFT JOIN gambar g ON k.id_kos = g.id_kos 
            LEFT JOIN status_user ON k.id_user = status_user.id_user
            WHERE status_user.status = 'aktif'
            GROUP BY k.id_kos ";

            if ($limit === true) {
                $query .= "LIMIT 0, 25;";
            }

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DetailKos($id)
    {
        try {
            $query = "SELECT 
    k.id_kos,
    k.nama_kos,
    k.deskripsi AS kos_deskripsi,
    k.tipe_kos,
    k.alamat,
    k.latitude,
    k.longitude,
    k.jenis_fasilitas AS fasilitas_kos,
    k.peraturan_kos,
    k.waktu_penyewaan,
    g.id_gambar,
    g.deskripsi AS gambar_deskripsi,
    km.id_kamar,
    km.luas_kamar,
    km.jenis_fasilitas,
    km.harga_bulan,
    km.harga_hari,
    km.harga_minggu,
    km.tipe_kamar,
    km.kamar_tersedia,
    AVG(u.rating) AS rating_kamar,
    COUNT(DISTINCT u.id_user) AS jumlah_rating,
    COALESCE(u.ulasan, 'No reviews') AS ulasan,
    COALESCE(u.rating, 0) AS rating,
    p.tanggal_penyewaan,
    p.status_penyewaan,
    p.waktu_penyewaan AS penyewaan_waktu_penyewaan,
    us.id_user AS id_pemilik,
    us.nama AS nama,
    us.id_gambar AS gambar

    FROM 
    kos k
    LEFT JOIN 
    kamar km ON k.id_kos = km.id_kos
    LEFT JOIN 
    gambar g ON k.id_kos = g.id_kos AND km.id_kamar = g.id_kamar
    LEFT JOIN 
    ulasan u ON k.id_kos = u.id_kos
    LEFT JOIN 
    penyewaan p ON k.id_kos = p.id_kos AND km.id_kamar = p.id_kamar
    LEFT JOIN
    user us ON k.id_user = us.id_user

    WHERE
    k.id_kos = :id

GROUP BY 
    k.id_kos, k.nama_kos, k.deskripsi, k.tipe_kos, k.alamat, k.latitude, k.longitude, 
    k.jenis_fasilitas, k.peraturan_kos, g.id_gambar, g.deskripsi, km.id_kamar, 
    km.luas_kamar, km.jenis_fasilitas, km.harga_bulan, km.tipe_kamar, 
    km.kamar_tersedia, k.waktu_penyewaan, p.tanggal_penyewaan, p.status_penyewaan, 
    p.waktu_penyewaan, us.id_user, us.nama;
";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->single();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
