<?php
require_once './app/core/Database.php';


class PembayaranModel
{
    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }


    public function getRiwayatPencari()
    {

        $query = "SELECT p.id_penyewaan AS id_penyewaan, DATE(p.tanggal_penyewaan) AS tanggal_penyewaan, p.waktu_penyewaan AS waktu_penyewaan, k.harga AS harga_kos FROM penyewaan p JOIN user u ON u.id_user = p.id_user JOIN kamar k ON k.id_kamar = p.id_kamar WHERE u.id_user = :id_user ORDER BY p.tanggal_penyewaan DESC";

        $this->db->query($query);
        $this->db->bind('id_user', $_SESSION['user']['id_user']);
        $this->db->execute();

        return $this->db->resultSet();
    }
    public function getRiwayatPemilik()
    {
        $query = "SELECT id_kos FROM kos WHERE id_user = :id_user";

        $this->db->query($query);
        $this->db->bind('id_user', $_SESSION['user']['id_user']);
        $this->db->execute();

        $kos = $this->db->single();
        // var_dump($kos);
        // die;
        $query = "SELECT penyewaan.id_penyewaan AS id_penyewaan, kos.id_kos, user.nama, DATE(penyewaan.tanggal_penyewaan) AS tanggal_penyewaan, TIME(penyewaan.waktu_penyewaan) AS waktu_penyewaan, kamar.harga AS harga_kos FROM penyewaan JOIN kos ON penyewaan.id_kos = kos.id_kos JOIN kamar ON kamar.id_kamar = penyewaan.id_kamar JOIN user ON user.id_user = kos.id_user WHERE kos.id_kos = :id_kos ORDER BY penyewaan.tanggal_penyewaan DESC;";

        $this->db->query($query);
        $this->db->bind('id_kos', $kos['id_kos']);
        $this->db->execute();

        return $this->db->resultSet();
    }
    public function insertPembayaran($id_user, $id_kamar, $id_kos, $totalkamar, $harga, $tanggal, $waktuPenyewaan)
    {
        $query = "INSERT INTO `penyewaan` (`id_penyewaan`, `tanggal_penyewaan`, `status_penyewaan`, `waktu_penyewaan`, `harga`, `total_kamar`, `id_kos`, `id_kamar`, `id_user`) VALUES ('', :tanggal_penyewaan, :status_penyewaan, :waktu_penyewaan, :harga, :totalkamar, :id_kos, :id_kamar, :id_user)";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_kamar', $id_kamar);
        $this->db->bind('id_kos', $id_kos);
        $this->db->bind('totalkamar', $totalkamar);
        $this->db->bind('status_penyewaan', "tersedia");
        $this->db->bind('harga', $harga);
        $this->db->bind('tanggal_penyewaan', $tanggal);
        $this->db->bind('waktu_penyewaan', $waktuPenyewaan);

        $this->db->execute();
        return  $this->db->lastInsertId();
    }
}
