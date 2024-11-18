<?php
class CardViewModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;  // Assuming the Database class is properly defined
    }

    public function SelectCardViewKosPoPular()
    {
        try {
            $query = "SELECT 
    k.id_kos, 
    k.nama_kos, 
    k.alamat,
    k.tipe_kos,
    km.harga AS harga, 
    (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, 
    AVG(u.rating) AS avg_rating, 
    COUNT(u.id_ulasan) AS review_count,
    km.waktu_penyewaan,
    km.status_kamar
FROM 
    kos k
LEFT JOIN 
    ulasan u ON k.id_kos = u.id_kos
LEFT JOIN 
    kamar km ON k.id_kos = km.id_kos
LEFT JOIN 
    gambar g ON k.id_kos = g.id_kos
GROUP BY 
    k.id_kos, km.status_kamar
ORDER BY 
    review_count DESC
LIMIT 0, 25";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function SelectCardViewKosBest()
    {
        try {
            $query = "SELECT 
    k.id_kos, 
    k.nama_kos, 
    k.alamat,
    k.tipe_kos,
    km.harga AS harga, 
    (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, 
    AVG(u.rating) AS avg_rating, 
    COUNT(u.id_ulasan) AS review_count,
    km.waktu_penyewaan,
    km.status_kamar
FROM 
    kos k
LEFT JOIN 
    ulasan u ON k.id_kos = u.id_kos
LEFT JOIN 
    kamar km ON k.id_kos = km.id_kos
LEFT JOIN 
    gambar g ON k.id_kos = g.id_kos
GROUP BY 
    k.id_kos, km.status_kamar
ORDER BY 
    avg_rating DESC
LIMIT 0, 25;
";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function SelectCardViewKosCampus()
    {
        try {
            $query = "SELECT 
    k.id_kos, 
    k.nama_kos, 
    k.alamat,
    k.tipe_kos, 
    km.harga AS harga, 
    (SELECT g.deskripsi FROM gambar g WHERE g.id_kos = k.id_kos LIMIT 1) AS gambar, 
    AVG(u.rating) AS avg_rating, 
    COUNT(u.id_ulasan) AS review_count,
    km.waktu_penyewaan,
    km.status_kamar
FROM 
    kos k
LEFT JOIN 
    ulasan u ON k.id_kos = u.id_kos
LEFT JOIN 
    kamar km ON k.id_kos = km.id_kos
LEFT JOIN 
    gambar g ON k.id_kos = g.id_kos
GROUP BY 
    k.id_kos, km.status_kamar
LIMIT 0, 25;";

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
    g.id_gambar,
    g.deskripsi AS gambar_deskripsi,
    km.id_kamar,
    km.luas_kamar,
    km.status_kamar,
    km.fasilitas_kamar,
    km.harga,
    km.tipe_kamar,
    km.kamar_tersedia,
    km.waktu_penyewaan AS kamar_waktu_penyewaan,
    AVG(u.rating) AS rating_kamar,
    COUNT(u.id_ulasan) AS jumlah_rating,
    COALESCE(u.ulasan, 'No reviews') AS ulasan,
    COALESCE(u.rating, 0) AS rating,
    p.tanggal_penyewaan,
    p.status_penyewaan,
    p.waktu_penyewaan AS penyewaan_waktu_penyewaan

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

WHERE 
    k.id_kos = :id

GROUP BY 
    k.id_kos, k.nama_kos, k.deskripsi, k.tipe_kos, k.alamat, k.latitude, k.longitude, 
    k.jenis_fasilitas, k.peraturan_kos, g.id_gambar, g.deskripsi, km.id_kamar, 
    km.luas_kamar, km.status_kamar, km.fasilitas_kamar, km.harga, km.tipe_kamar, 
    km.kamar_tersedia, km.waktu_penyewaan, p.tanggal_penyewaan, p.status_penyewaan, 
    p.waktu_penyewaan;
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
?>