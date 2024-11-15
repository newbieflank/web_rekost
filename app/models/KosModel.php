<?php

class KosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahDataKos($data)
    {
        try {
            $this->db->beginTransaction();

            $query = "INSERT INTO kos (nama_kos, deskripsi, tipe_kos, peraturan_kos, jenis_fasilitas, alamat, latitude, longitude, id_user) 
                     VALUES (:nama_kos, :deskripsi, :tipe_kos, :peraturan_kos, :jenis_fasilitas, :alamat, :latitude, :longitude, :id_user)";

            $this->db->query($query);
            $this->db->bind('nama_kos', $data['nama_kos']);
            $this->db->bind('deskripsi', $data['deskripsi']);
            $this->db->bind('tipe_kos', $data['tipe_kos']);
            $this->db->bind('peraturan_kos', $data['peraturan_kos']);
            $this->db->bind('jenis_fasilitas', $data['jenis_fasilitas']);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('latitude', $data['latitude']);
            $this->db->bind('longitude', $data['longitude']);
            $this->db->bind('id_user', $data['id_user']);

            $this->db->execute();
            $kosId = $this->db->lastInsertId();

            $this->db->commit();
            return $kosId;

        } catch (PDOException $e) {
            $this->db->rollBack();
        }
    }

    public function tambahGambarKos($data)
    {
        try {
            $query = "INSERT INTO gambar (id_gambar, id_kos, deskripsi) 
                     VALUES (:id_gambar, :id_kos, :deskripsi)";

            $this->db->query($query);
            $this->db->bind('id_gambar', $data['id_gambar']);
            $this->db->bind('id_kos', $data['id_kos']);
            $this->db->bind('deskripsi', $data['deskripsi']);

            return $this->db->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function tambahDataKamar($data)
    {
        try {
            $this->db->beginTransaction();

            $query = "INSERT INTO kamar (tipe_kamar, luas_kamar, status_kamar, fasilitas_kamar, harga, kamar_tersedia, id_kos) 
                     VALUES (:tipe_kamar, :luas_kamar, :status_kamar, :fasilitas_kamar, :harga, :kamar_tersedia, :id_kos)";

            $this->db->query($query);
            $this->db->bind('tipe_kamar', $data['tipe_kamar']);
            $this->db->bind('luas_kamar', $data['luas_kamar']);
            $this->db->bind('status_kamar', $data['status_kamar']);
            $this->db->bind('fasilitas_kamar', $data['fasilitas_kamar']);
            $this->db->bind('harga', $data['harga']);
            $this->db->bind('kamar_tersedia', $data['kamar_tersedia']);
            $this->db->bind('id_kos', $data['id_kos']);

            $this->db->execute();
            $kamarId = $this->db->lastInsertId();

            $this->db->commit();
            return $kamarId;

        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function tambahGambarKamar($data)
    {
        try {
            $query = "INSERT INTO gambar (id_gambar, id_kamar, id_kos, deskripsi) 
                     VALUES (:id_gambar, :id_kamar, :id_kos, :deskripsi)";

            $this->db->query($query);
            $this->db->bind('id_gambar', $data['id_gambar']);
            $this->db->bind('id_kamar', $data['id_kamar']);
            $this->db->bind('id_kos', $data['id_kos']);
            $this->db->bind('deskripsi', $data['deskripsi']);

            return $this->db->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getLatestKosId($userId)
    {
        $query = "SELECT id_kos FROM kos WHERE id_user = :id_user ORDER BY id_kos DESC LIMIT 1";
        $this->db->query($query);
        $this->db->bind('id_user', $userId);
        $result = $this->db->single();
        return $result ? $result['id_kos'] : null;
    }

}