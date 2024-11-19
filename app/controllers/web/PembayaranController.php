<?php

class PembayaranController extends Controller
{
    private $kosModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }

        $this->kosModel = $this->model('KosModel');
    }
    public function konfirmasi($id)
    {
        $kos = $this->kosModel->getData($id);
        // var_dump($kos, $id);
        // die;
        $this->view('pembayaran/konfirmasi', [
            'kos' => $kos
        ]);
    }

    public function riwayatPencari()
    {

        $pembayaranModel = $this->model('PembayaranModel');
        $riwayat = $pembayaranModel->getRiwayatPencari();
        $this->view('history/historypencari', [
            'riwayat' => $riwayat
        ]);
    }
    public function riwayatPemilik()
    {
        // var_dump('tes');
        // die;
        $pembayaranModel = $this->model('PembayaranModel');
        $riwayat = $pembayaranModel->getRiwayatPemilik();

        $this->view('history/historypemilik', [
            'riwayat' => $riwayat
        ]);
    }
    public function insertPembayaran()
    {
        // var_dump($_POST);
        // die;
        $id_user = $_SESSION['user']['id_user'];
        $buktiPembayaran = $_FILES['buktiPembayaran'];

        $totalkamar = $_POST['totalKamar'];
        $harga = $_POST['totalHarga'];
        $tanggal = date('Y-m-d');
        $waktuPenyewaan = $_POST['waktu_penyewaan'];
        $id_kamar = $_POST['id_kamar'];
        $id_kos = $_POST['id_kos'];


        $idPenyewaan = $this->model('PembayaranModel')->insertPembayaran($id_user, $id_kamar, $id_kos, $totalkamar, $harga, $tanggal, $waktuPenyewaan);


        $tmp_name = $buktiPembayaran['tmp_name'];
        $targetFilePath = "./public/uploads/$id_user/$idPenyewaan.jpg";

        move_uploaded_file($tmp_name, $targetFilePath);
        $this->header('/riwayat');
    }
}
