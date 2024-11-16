<?php
class RatingAplikasiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function GetUlasan()
    {
        try {
            $query = "SELECT 
    user.nama AS nama_user,
    user.alamat AS alamat_user,
    ulasan_aplikasi.ulasan AS review,
    ulasan_aplikasi.rating AS rating,
    ulasan_aplikasi.tanggal_ulas AS tanggal_review,
    COUNT(*) OVER() AS total_rating
    FROM 
    ulasan_aplikasi
    JOIN 
    user ON ulasan_aplikasi.id_user = user.id_user
    ORDER BY 
    ulasan_aplikasi.rating DESC;";

            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function GetTotalPenyewa(){
        try {
            $query = "SELECT COUNT(*) AS jumlah_penyewa FROM penyewaan";
            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function AddRating($data){
        try {
            $query = "INSERT INTO `ulasan_aplikasi` (`id_user`, `ulasan`,`rating`) VALUES (:id_user, :ulasan, :rating)";
            $this->db->query($query);
            $this->db->bind('id_user', $data['id_user']);
            $this->db->bind('ulasan', $data['ulasan']);
            $this->db->bind('rating',$data['rating']);
            $this->db->execute();
            return $this->db->rowCount();

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
?>