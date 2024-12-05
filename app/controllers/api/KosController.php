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

        // Retrieve JSON data sent to the API
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($_POST) || empty($_FILES)) {
            echo json_encode([
                "status" => "error",
                "message" => "Pastikan Semua data terisi beserta dengan bukti"
            ]);
            return;
        }

        // Ambil data dari request JSON
        $id_user = intval(value: $_POST['id_user']);
        $id_kamar = intval($_POST['id_kamar']);
        $id_kos = intval($_POST['id_kos']);
        $buktiPembayaran = $_FILES['buktiPembayaran'];
        $totalkamar = intval($_POST['totalkamar']);
        $harga = intval($_POST['harga']);
        $tanggal = $_POST['tanggal_penyewaan'];
        // $waktuPenyewaan = $_POST['waktu_penyewaan'];
        $durasiWaktu = $_POST['durasi'];
        // Tentukan waktu sewa dan durasi berdasarkan pilihan

        switch ($durasiWaktu) {
            case "Harian":
                $waktuSewa = "harian";
                $durasi = 1;

                break;
            case "Mingguan":
                $waktuSewa = "mingguan";
                $durasi = 7;
                break;
            case "Bulanan":
                $waktuSewa = "1 bulan";
                $durasi = 30;
                break;
            case "6 Bulan":
                $waktuSewa = "3 bulan";
                $durasi = 90;
                break;
            case "Tahunan":
                $waktuSewa = "tahunan";
                $durasi = 365;
                break;
        }



        $idPenyewaan = $this->model('PembayaranModel')->insertPembayaran($id_user, $id_kamar, $id_kos, $totalkamar, $durasi, $harga, $tanggal, $waktuSewa);

        if ($idPenyewaan > 0) {

            $tmp_name = $buktiPembayaran['tmp_name'];
            $targetFilePath = "./public/uploads/$id_user/$idPenyewaan.jpg";

            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $response = [
                    "status" => "success",
                    "message" => "Berhasil Mengunggah Pembayaran"
                ];
                echo json_encode($response);
            } else {
                $response = [
                    "status" => "failed",
                    "message" => "Gagal Mengunggah Bukti Pembayaran"
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                "status" => "failed",
                "message" => "Gagal Mengunggah Pembayaran"
            ];
            echo json_encode($response);
        }
    }
}
