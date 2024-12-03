<?php

class KosController extends Controller
{

    private $kos;
    private $detail;

    public function __construct()
    {
        $this->kos = $this->model('KosModel');
        $this->detail = $this->model('CardViewModel');
    }
    public function getKos()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $user = $this->kos->getDataAll();

        echo json_encode(['status' => 'success', 'data' => $user]);
    }
    public function getKosBest()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $user = $this->kos->getDataBest();

        echo json_encode(['status' => 'success', 'data' => $user]);
    }
    public function getKosTerdekat()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $user = $this->kos->getDataTerdekat();

        echo json_encode(['status' => 'success', 'data' => $user]);
    }
    public function getAllKos()
    {
        // header("Access-Control-Allow-Origin: *");
        // header('Content-Type: application/json');
        $lokasi = $_POST['lokasi'];
        $hargaawal = $_POST['hargaawal'];
        $hargaakhir = $_POST['hargaakhir'];
        // echo json_encode(['status' => 'success', 'data' => $hargaawal]);
        $user = $this->kos->getAllKos($lokasi, $hargaawal, $hargaakhir);
        echo json_encode(['data' => $user, 'status' => 'success']);
    }

    public function getDetailKos($id)
    {
        $detail = $this->detail->DetailKos($id);
        if ($detail) {
            $response = [
                'status' => 'success',
                'message' => 'Data Berhasil Di Dapat',
                'data' => [$detail]
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'detail missing',
            ];
        }

        echo json_encode($response);
    }

    public function getImageKos($id)
    {

        $idKos = $id;
        $kos = $this->model('KosModel')->Data($idKos);

        // Define the path where user images are stored
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $kosDir = $baseDir . $idKos . '/';


        if (is_dir($kosDir)) {

            $imageFiles = glob($kosDir . "*.{png,jpg,jpeg,gif}", GLOB_BRACE);
            if (!empty($imageFiles)) {
                $imageUrls = [];
                foreach ($imageFiles as $filePath) {
                    $relativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $filePath);
                    $imageUrls[] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $relativePath;
                }
                header("Content-Type: application/json");
                echo json_encode(["success" => true, "images" => $imageUrls]);
                exit;
            } else {
                header("HTTP/1.0 404 Not Found");
                echo json_encode(["success" => false, "message" => "No image found for this user."]);
                exit;
            }
        } else {
            // User directory does not exist
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["success" => false, "message" => "User directory does not exist."]);
            exit;
        }
    }

    public function konfirmPembayaran()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid input data"
            ]);
            return;
        }

        // Cek apakah data yang diperlukan ada dalam request
        if (!isset($data['totalHarga']) || !isset($data['waktu_penyewaan']) || !isset($data['id_kamar']) || !isset($data['id_kos'])) {
            echo json_encode(['error' => 'Data yang dibutuhkan tidak lengkap']);
            return;
        }

        // Ambil data dari request JSON
        $id_user = $_SESSION['user']['id_user'];
        $harga = $data['totalHarga'];
        $waktuPenyewaan = $data['waktu_penyewaan'];

        // Tentukan waktu sewa dan durasi berdasarkan pilihan
        switch ($waktuPenyewaan) {
            case 1:
                $waktuSewa = "Harian";
                $durasi = $data['customDays'];
                break;
            case 2:
                $waktuSewa = "mingguan";
                $durasi = 7;
                break;
            case 3:
                $waktuSewa = "Bulanan";
                $durasi = 30;
                break;
            default:
                echo json_encode(['error' => 'Waktu penyewaan tidak valid']);
                return;
        }

        // Ambil id_kamar dan id_kos dari data JSON
        $id_kamar = $data['id_kamar'];
        $id_kos = $data['id_kos'];

        // Panggil model untuk insert pembayaran
        $idPenyewaan = $this->model('PembayaranModel')->insertPembayaran($id_user, $id_kamar, $id_kos, $harga, $waktuSewa);

        if ($idPenyewaan > 0) {
            // Tangani file bukti pembayaran jika ada
            if (isset($_FILES['buktiPembayaran'])) {
                $buktiPembayaran = $_FILES['buktiPembayaran'];
                $tmp_name = $buktiPembayaran['tmp_name'];
                $targetFilePath = "./public/uploads/$id_user/$idPenyewaan.jpg";

                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    // Jika file berhasil diupload, kirim response sukses
                    echo json_encode(['success' => 'Pembayaran berhasil dilakukan', 'idPenyewaan' => $idPenyewaan]);
                } else {
                    // Jika file gagal diupload
                    echo json_encode(['error' => 'Gagal mengupload bukti pembayaran']);
                }
            } else {
                echo json_encode(['error' => 'Bukti pembayaran tidak ditemukan']);
            }
        } else {
            // Jika penyewaan gagal disimpan
            echo json_encode(['error' => 'Gagal menyimpan pembayaran']);
        }
    }
}
