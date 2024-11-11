<?php

class DataKosController extends Controller
{
    private $KosModel;

    public function __construct()
    {
        $this->KosModel = $this->model('KosModel');
    }

    public function datakos()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login');
            exit;
        }

        ob_start();
        $this->view('data_kos/inputkos');
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",
        ];

        $this->view('layout/main', $data);
    }

    public function tambah()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login');
            exit;
        }

        try {
            $userId = $_SESSION['user']['id_user'];

            $kosData = [
                'nama_kos' => $_POST['nama_kos'],
                'deskripsi' => $_POST['deskripsi'],
                'tipe_kos' => $_POST['tipekos'],
                'peraturan_kos' => $_POST['peraturan'],
                'jenis_fasilitas' => implode(',', $_POST['fasilitas']),
                'alamat' => $_POST['alamat'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'id_user' => $userId
            ];
            $uploadedImages = [];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/kos/' . $userId . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageFields = ['foto_depan', 'foto_belakang', 'foto_dalam', 'foto_jalan'];
            foreach ($imageFields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES[$field];

                    if (!in_array($file['type'], $allowedTypes)) {
                        throw new Exception("Invalid file type for $field");
                    }

                    $fileName = uniqid() . '_' . basename($file['name']);
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $uploadedImages[$field] = $fileName;
                    }
                }
            }

            $kosId = $this->KosModel->tambahDataKos($kosData);

            if ($kosId) {
                foreach ($uploadedImages as $imageType => $fileName) {
                    $imageData = [
                        'id_gambar' => $fileName,
                        'id_kos' => $kosId,
                        'deskripsi' => $imageType
                    ];
                    $this->KosModel->tambahGambarKos($imageData);
                }

                $response = ['success' => true, 'message' => 'Data kos berhasil ditambahkan'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal menambahkan data kos'];
            }

        } catch (Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    public function fasilitas()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login');
            exit;
        }

        ob_start();
        $this->view('data_kos/inputkamar');
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",
        ];

        $this->view('layout/main', $data);
    }

    public function tambahFasilitas()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login');
            exit;
        }

        try {
            $userId = $_SESSION['user']['id_user'];

            $kosId = $this->KosModel->getLatestKosId($userId);

            $kamarData = [
                'tipe_kamar' => $_POST['tipe_kamar'],
                'luas_kamar' => $_POST['ukuran_kamar'],
                'status_kamar' => $_POST['status_kamar'],
                'fasilitas_kamar' => implode(',', $_POST['fasilitas_kamar']),
                'harga' => $_POST['harga'],
                'kamar_tersedia' => $_POST['kamar_tersedia'],
                'id_kos' => $kosId
            ];

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/' . $userId . '/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageFields = ['foto_depan_kamar', 'foto_kamar_mandi', 'foto_dalam_kamar', 'foto_lain'];
            $uploadedImages = [];

            foreach ($imageFields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES[$field];
                    $fileName = uniqid() . '_' . basename($file['name']);
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $uploadedImages[$field] = $fileName;
                    }
                }
            }

            $kamarId = $this->KosModel->tambahDataKamar($kamarData);

            if ($kamarId) {
                foreach ($uploadedImages as $imageType => $fileName) {
                    $imageData = [
                        'id_gambar' => $fileName,
                        'id_kamar' => $kamarId,
                        'id_kos' => $kosId,
                        'deskripsi' => $imageType
                    ];
                    $this->KosModel->tambahGambarKamar($imageData);
                }

                $response = ['success' => true, 'message' => 'Data kamar berhasil ditambahkan'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal menambahkan data kamar'];
            }

        } catch (Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}