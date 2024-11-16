<?php

class DataKosController extends Controller
{
    private $KosModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }
        $this->KosModel = $this->model('KosModel');
    }

    public function datakos()
    {
        $id_user = $_SESSION['user']['id_user'];
        $id_kos = $_SESSION['user']['id_kos'];

        $kos = $this->KosModel->getData($id_kos);
        $user = $this->model('UsersModel')->findUserById($id_user);

        $array = $kos['jenis_fasilitas'];
        $fasilitas = explode(',', $array);
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $imagePath = $baseDir . $id_user . '/' . $id_kos;

        $dataKos = [
            'namaKos' => $kos['nama_kos'],
            'deskripsi' => $kos['deskripsi'],
            'tipe' => $kos['tipe_kos'],
            'alamat' => $kos['alamat'],
            'peraturan' => $kos['peraturan_kos'],
            'fasilitas' => $fasilitas,
            'latitude' => $kos['latitude'],
            'longitude' => $kos['longitude'],
            'imagePath' => $imagePath,
            'id_user' => $id_user,
            'id_kos' => $id_kos
        ];

        ob_start();
        $this->view('data_kos/formkos', $dataKos);
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",
            "id_user" => $user['id_user'],
            "id_gambar" => $user['id_gambar'],
            "id_kos" => $id_kos
            // "footer" => false
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
            $idKos = $_SESSION['user']['id_kos'];
            $user = $_SESSION['user']['id_user'];

            $kosData = [
                'nama_kos' => $_POST['nama_kos'],
                'deskripsi' => $_POST['deskripsi'],
                'tipe_kos' => $_POST['tipekos'],
                'peraturan_kos' => $_POST['peraturan'],
                'jenis_fasilitas' => $_POST['fasilitas'],
                'alamat' => $_POST['alamat'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'id_kos' => $idKos
            ];

            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $user . '/' . $idKos . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileMappings = [
                'foto_depan' => 'foto_depan',
                'foto_belakang' => 'foto_belakang',
                'foto_dalam' => 'foto_dalam',
                'foto_jalan' => 'foto_jalan',
            ];

            // Insert kos data into the database
            $kosId = $this->KosModel->tambahDataKos($kosData);

            if ($kosId > 0) {
                foreach ($fileMappings as $inputName => $customName) {
                    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
                        $newFileName = $customName . '.jpg';
                        $targetFilePath = $uploadDir . $newFileName;

                        if (file_exists($targetFilePath)) {
                            // Replace the existing file
                            unlink($targetFilePath);
                        }

                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                            $response = ['success' => true, 'message' => 'Data kos berhasil di Ubah'];
                        } else {
                            $response = ['success' => false, 'message' => 'Gagal Mengunggah Foto'];
                        }
                    } else {
                        $response = ['success' => true, 'message' => 'Data Kos berhasil di Ubah'];
                    }
                }
            } else if ($_FILES) {
                foreach ($fileMappings as $inputName => $customName) {
                    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
                        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
                        $newFileName = $customName . '.jpg';
                        $targetFilePath = $uploadDir . $newFileName;

                        if (file_exists($targetFilePath)) {
                            // Replace the existing file
                            unlink($targetFilePath);
                        }

                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                            $response = ['success' => true, 'message' => 'Data kos berhasil di Ubah'];
                        } else {
                            $response = ['success' => false, 'message' => 'Gagal Mengunggah Foto'];
                        }
                    } else {
                        $response = ['success' => true, 'message' => 'Data Kos berhasil di Ubah'];
                    }
                }
            } else {
                $response = ['success' => false, 'message' => 'Gagal Mengubah Data Kos', $kosData];
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
        $this->view('data_kos/formkamar');
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

            $userId = $_SESSION['user']['id_kos'];


            $KamarData = [
                'luas_kamar' => $_POST['luas_kamar'],
                'jenis_fasilitas' => $_POST['fasilitas'],
                'harga_bulan' => $_POST['harga_bulan'],
                'kamar_tersedia' => $_POST['kamar_tersedia'],
                'tipe_kamar' => $_POST['tipe_kamar'],
                'total_kamar' => $_POST['total_kamar'],
                'harga_minggu' => $_POST['harga_minggu'],
                'harga_hari' => $_POST['harga_hari'],
                'id_kos' => $userId
            ];

            -$kamarid = $this->KosModel->tambahDataKamar($KamarData);

            if ($kamarid > 0) {
                $response = ['success' => true, 'message' => 'Data kamar berhasil ditambahkan', $KamarData];
                $this->header('/datakos');
                exit;
            } else {
                $response = ['success' => false, 'message' => 'Gagal menambahkan data kamar', $KamarData];
            }
        } catch (Exception $e) {
            error_log('Error Message: ' . $e->getMessage());
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
