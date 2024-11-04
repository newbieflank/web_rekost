<?php

class KosModel
{
    private $table = 'kos';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambahDataKos($data)
    {
        if (empty($data['nama_kos']) || empty($data['jumlah_kamar'])) {
            return false;
        }

        $query = "INSERT INTO kos 
                      (nama_kos, jumlah_kamar, tipe_kos, deskripsi, peraturan_kos) 
                      VALUES 
                      (:nama_kos, :jumlah_kamar, :tipe_kos, :deskripsi, :peraturan_kos)";

        try {
            $this->db->query($query);
            $this->db->bind('nama_kos', $data['nama_kos']);
            $this->db->bind('jumlah_kamar', $data['jumlah_kamar']);
            $this->db->bind('tipe_kos', $data['tipe_kos']);
            $this->db->bind('deskripsi', $data['deskripsi']);
            $this->db->bind('peraturan_kos', $data['peraturan_kos']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            // Handle error
            return false;
        }
    }

    public function updateFasilitas($data)
    {
        $query = "UPDATE kos 
              SET fasilitas_umum = :fasilitas_umum,
                  fasilitas_kamar = :fasilitas_kamar,
                  fasilitas_kamar_mandi = :fasilitas_kamar_mandi,
                  fasilitas_parkir = :fasilitas_parkir,
                  fasilitas_luar = :fasilitas_luar
              WHERE id_kos = (SELECT MAX(id_kos) FROM kos)";

        try {
            $this->db->query($query);
            $this->db->bind('fasilitas_umum', $data['fasilitas_umum']);
            $this->db->bind('fasilitas_kamar', $data['fasilitas_kamar']);
            $this->db->bind('fasilitas_kamar_mandi', $data['fasilitas_kamar_mandi']);
            $this->db->bind('fasilitas_parkir', $data['fasilitas_parkir']);
            $this->db->bind('fasilitas_luar', $data['fasilitas_luar']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAlamast($data)
    {
        $query = "UPDATE kos 
              SET alamat = :alamat,
                  latitude = :latitude,
                  longitude = :longitude 
              WHERE id_kos = (SELECT MAX(id_kos) FROM kos)";

        try {
            $this->db->query($query);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('latitude', $data['latitude']);
            $this->db->bind('longitude', $data['longitude']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateAlamat($data)
    {
        $query = "UPDATE kos 
              SET alamat = :alamat,
                  latitude = :latitude,
                  longitude = :longitude 
              WHERE id_kos = (SELECT MAX(id_kos) FROM kos)";

        try {
            error_log('Data alamat yang diterima: ' . print_r($data, true));

            $this->db->query($query);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('latitude', $data['latitude']);
            $this->db->bind('longitude', $data['longitude']);

            $result = $this->db->execute();

            error_log('Hasil execute: ' . ($result ? 'success' : 'failed'));
            error_log('Rows affected: ' . $this->db->rowCount());

            return $this->db->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating alamat: ' . $e->getMessage());
            return false;
        }
    }

    public function updateHarga($data)
    {
        $query = "UPDATE kos 
              SET harga_kos = :harga_kos
              WHERE id_kos = (SELECT MAX(id_kos) FROM kos)";

        try {
            $this->db->query($query);
            $this->db->bind('harga_kos', $data['harga_kos']);

            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            error_log('Error updating harga: ' . $e->getMessage());
            return false;
        }
    }

}