<?php

class KosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData($id)
    {
        $query = "SELECT * FROM kos JOIN kamar ON kos.id_kos = kamar.id_kos where kos.id_kos = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getDataAll()
    {
        $query = "SELECT * FROM kos JOIN kamar ON kos.id_kos = kamar.id_kos";

        $this->db->query($query);
        return $this->db->single();
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
            do {
                $idKamar = $this->generateKamarId();
                $query = "SELECT COUNT(*) as count FROM kamar WHERE id_kamar = :id_kamar";
                $this->db->query($query);
                $this->db->bind(':id_kamar', $idKamar);
                $result = $this->db->single();
            } while ($result['count'] > 0);

            $query2 = "INSERT INTO kamar (
                id_kamar,
                luas_kamar, 
                jenis_fasilitas, 
                harga_bulan,      
                tipe_kamar,
                kamar_tersedia, 
                id_kos,
                total_kamar,
                harga_minggu,     
                harga_hari        
            ) VALUES (
                :id_kamar,
                :luas_kamar,
                :jenis_fasilitas,
                :harga_bulan,     
                :tipe_kamar,
                :kamar_tersedia,
                :id_kos,
                :total_kamar,
                :harga_minggu,    
                :harga_hari       
            )";

            $this->db->query($query2);

            $this->db->bind(':id_kamar', $idKamar);
            $this->db->bind(':luas_kamar', $data['luas_kamar']);
            $this->db->bind('jenis_fasilitas', $data['jenis_fasilitas']);
            $this->db->bind(':harga_bulan', $data['harga_bulan']);
            $this->db->bind(':tipe_kamar', $data['tipe_kamar']);
            $this->db->bind(':kamar_tersedia', $data['kamar_tersedia']);
            $this->db->bind(':total_kamar', $data['total_kamar']);
            $this->db->bind(':harga_minggu', $data['harga_minggu']);
            $this->db->bind(':harga_hari', $data['harga_hari']);
            $this->db->bind(':id_kos', $data['id_kos']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    // public function tambahDataKamar($data)
    // {
    //     try {
    //         $query2 = "INSERT INTO kamar (
    //         luas_kamar, 
    //         jenis_fasilitas, 
    //         harga_bulan,      
    //         tipe_kamar,
    //         kamar_tersedia, 
    //         id_kos,
    //         total_kamar,
    //         harga_minggu,     
    //         harga_hari        
    //     ) VALUES (
    //         :luas_kamar,
    //         :jenis_fasilitas,
    //         :harga_bulan,     
    //         :tipe_kamar,
    //         :kamar_tersedia,
    //         :id_kos,
    //         :total_kamar,
    //         :harga_minggu,    
    //         :harga_hari       
    //     )";

    //         $this->db->query($query2);

    //         $this->db->bind(':luas_kamar', $data['luas_kamar']);
    //         $this->db->bind('jenis_fasilitas', $data['jenis_fasilitas']);
    //         $this->db->bind(':harga_bulan', $data['harga_bulan']);
    //         $this->db->bind(':tipe_kamar', $data['tipe_kamar']);
    //         $this->db->bind(':kamar_tersedia', $data['kamar_tersedia']);
    //         $this->db->bind(':total_kamar', $data['total_kamar']);
    //         $this->db->bind(':harga_minggu', $data['harga_minggu']);
    //         $this->db->bind(':harga_hari', $data['harga_hari']);
    //         $this->db->bind(':id_kos', $data['id_kos']);

    //         $this->db->execute();
    //         return $this->db->rowCount();
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    public function cekIdTransaksi($id)
    {
        //isi query buat check ID Transaksi
    }
}
