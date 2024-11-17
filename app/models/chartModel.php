<?php
class chartModel{
    
    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }


    public function getpendapatan(){
    try {
    $query = "SELECT 
    jenis_transaksi,
    SUM(jumlah) AS total_jumlah
FROM 
    manajemen_pemilik
WHERE 
    jenis_transaksi = 'pendapatan'
GROUP BY 
    jenis_transaksi;
";
    
    $this ->db->query ($query);
    $results = $this ->db->resultSet();
    return $results;
} 
    catch (\Throwable $e) {
    echo "error" . Se->getMessage();
    //throw $th;
}

    }

    public function getpengeluaran(){
        try {
        $query = "SELECT 
        jenis_transaksi,
        SUM(jumlah) AS total_jumlah
    FROM 
        manajemen_pemilik
    WHERE 
        jenis_transaksi = 'pengeluaran'
    GROUP BY 
        jenis_transaksi;
    ";
        
        $this ->db->query ($query);
        $results = $this ->db->resultSet();
        return $results;
    } 
        catch (\Throwable $e) {
        echo "error" . Se->getMessage();
    }
    
        }



    public function getUlasan(){
        try{
            $query = "SELECT 
            k.id_kos,
            k.nama_kos,
            COALESCE(SUM(u.rating) / (COUNT(u.rating) * 5), 0) AS rata_rata_rating
        FROM 
            kos k
        LEFT JOIN 
            ulasan u ON k.id_kos = u.id_kos
        GROUP BY 
            k.id_kos, k.nama_kos;
            ";
        


            $this ->db->query($query);
            $results = $this ->db->resultSet();
            return $results;

        }
        catch (\Throwable $e){
            echo "error". Se->getMessage();

        }
    }

    public function Ulasanuser(){
        try {
            $query="SELECT 
            ulasan.id_ulasan,
            ulasan.tanggal_ulas,
            ulasan.ulasan,
            ulasan.rating,
            user.nama AS nama_user,
            user.email AS email_user,
            user.number_phone AS nomor_telepon,
            kos.nama_kos AS nama_kos,
            kos.alamat AS alamat_kos,
            kos.tipe_kos AS tipe_kos
        FROM 
            ulasan
        JOIN 
            user ON ulasan.id_user = user.id_user
        JOIN 
            kos ON ulasan.id_kos = kos.id_kos
        ORDER BY 
            ulasan.tanggal_ulas DESC;"
        
            $this->db->query($query);
            $results = $this->db->resultSet();
            return $results;

        } 
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
        
        

    public function AddRating($data){
        try {
            $query = "INSERT INTO `ulasan` (`id_user`, `ulasan`) VALUES (:id_user, :ulasan)";
            $this->db->query($query);
            $this->db->bind('id_user', $data['id_user']);
            $this->db->bind('ulasan', $data['ulasan']);
            $this->db->execute();
            return $this->db->rowCount();

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
?>