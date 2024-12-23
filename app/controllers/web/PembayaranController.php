<?php

class PembayaranController extends Controller
{
    private $kosModel;
    private $userModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }

        $this->kosModel = $this->model('KosModel');
        $this->userModel = $this->model('UsersModel');
    }
    public function konfirmasi($id)
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $kos = $this->kosModel->getData($id);
        $array = $kos['waktu_penyewaan'];
        $penyewaan = explode(',', $array);

        ob_start();
        $this->view('pembayaran/konfirmasi', [
            'kos' => $kos,
            'penyewaan' => $penyewaan
        ]);



        $content = ob_get_clean();

        $data = [
            "content" => $content,
            'title' => "Konfirmasi Pemesanan",
            "role" => $user['role'],
            'id_user' => $user['id_user'],
            'id_gambar' => $user['id_gambar']
        ];
        $this->view('layout/main', $data);
    }

    public function riwayatPencari()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $pembayaranModel = $this->model('PembayaranModel');
        $riwayat = $pembayaranModel->getRiwayatPencari();
        // var_dump($riwayat);
        // die;
        if ($user['role'] === 'pencari kos') {
            $this->renderProfile('history/historypencari', [
                'riwayat' => $riwayat,
                'id_user' => $user['id_user']
            ]);
        } else {
            $this->renderProfile('history/historypemilik', [
                'riwayat' => $riwayat,
                'id_user' => $user['id_user'],
            ]);
        }
    }

    private function renderProfile($viewPath, $data = [])
    {
        $email = $_SESSION['user']['email'];
        $user = $this->model('UsersModel')->findUserByEmail($email);

        ob_start();
        $this->view($viewPath, $data);
        $content = ob_get_clean();

        $layoutData = [
            "content" => $content,
            "title" => 'Riwayat',
            "role" => $user['role'],
            "id_user" => $user['id_user'],
            "id_gambar" => $user['id_gambar'],
            "footer" => false
        ];

        // echo $role = $this->getRole();

        $this->view('layout/main', $layoutData);
    }


    public function riwayatPemilik()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $pembayaranModel = $this->model('PembayaranModel');
        $riwayat = $pembayaranModel->getRiwayatPemilik();

        $this->view('history/historypemilik', [
            'riwayat' => $riwayat,
            'id_user' => $user['id_user'],
        ]);
    }
    public function insertPembayaran()
    {
        $id_user = $_SESSION['user']['id_user'];
        $buktiPembayaran = $_FILES['buktiPembayaran'];

        $totalkamar = $_POST['totalKamar'];
        $harga = $_POST['totalHarga'];
        $tanggal = date('Y-m-d');
        $waktuPenyewaan = $_POST['waktu_penyewaan'];

        switch ($waktuPenyewaan) {
            case 1:
                $waktuSewa = "harian";
                $durasi = $_POST['customDays'];

                break;
            case 2:
                $waktuSewa = "mingguan";
                $durasi = 7;
                break;
            case 3:
                $waktuSewa = "1 bulan";
                $durasi = 30;
                break;
            case 4:
                $waktuSewa = "3 bulan";
                $durasi = 90;
                break;
            case 5:
                $waktuSewa = "tahunan";
                $durasi = 365;
                break;
        }

        $id_kamar = $_POST['id_kamar'];
        $id_kos = $_POST['id_kos'];



        $idPenyewaan = $this->model('PembayaranModel')->insertPembayaran($id_user, $id_kamar, $id_kos, $totalkamar, $durasi, $harga, $tanggal, $waktuSewa);

        if ($idPenyewaan > 0) {


            $uploadDir = uploads($id_user . '/');

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $tmp_name = $buktiPembayaran['tmp_name'];
            $targetFilePath = $uploadDir . "$idPenyewaan.jpg";
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $this->header('/riwayat');
                exit;
            } else {
                echo "error";
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
    public function addrating()
    {
        $this->model('PembayaranModel')->insertRating();
        $this->header('/riwayat');
    }
}
