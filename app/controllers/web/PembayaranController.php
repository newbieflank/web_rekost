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

        switch ($waktuPenyewaan) {
            case 1:
                $waktuSewa = "harian";
                break;
            case 2:
                $waktuSewa = "mingguan";
                break;
            case 3:
                $waktuSewa = "1 bulan";
                break;
            case 4:
                $waktuSewa = "3 bulan";
                break;
            case 5:
                $waktuSewa = "tahunan";
                break;
        }

        $id_kamar = $_POST['id_kamar'];
        $id_kos = $_POST['id_kos'];
        $durasi = $_POST['customDays'];

        $idPenyewaan = $this->model('PembayaranModel')->insertPembayaran($id_user, $id_kamar, $id_kos, $totalkamar, $durasi, $harga, $tanggal, $waktuSewa);

        if ($idPenyewaan > 0) {

            $tmp_name = $buktiPembayaran['tmp_name'];
            $targetFilePath = "./public/uploads/$id_user/$idPenyewaan.jpg";

            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $this->header('/riwayat');
                exit;
            } else {
                echo "gagal";
            }
        } else {
            $data = [
                'total_kamar' => $totalkamar,
                'harga' => $harga,
                'tanggal' => $tanggal,
                'waktu' => $waktuPenyewaan,
                'id_kamar' => $id_kamar,
                'id_kos' => $id_kos,
                'durasi' => $durasi
            ];

            echo json_encode($data);
        }
    }
    public function getId()
    {
        do {
            $dateTime = date('Ymd');
            $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

            $generatedId = $dateTime . $randomNumber;
            $check = $this->kosModel->cekIdTransaksi($generatedId);
        } while ($check);

        return $generatedId;
    }
}
