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

        $kos = $this->KosModel->Data($id_kos);
        $user = $this->model('UsersModel')->findUserById($id_user);

        $array = $kos['jenis_fasilitas'];
        $fasilitas = explode(',', $array);
        $array_penyewaan = $kos['waktu_penyewaan'];
        $penyewaan = explode(',', $array_penyewaan);
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $imagePath = $baseDir .  $id_kos;

        $dataKos = [
            'namaKos' => $kos['nama_kos'],
            'deskripsi' => $kos['deskripsi'],
            'tipe' => $kos['tipe_kos'],
            'alamat' => $kos['alamat'],
            'peraturan' => $kos['peraturan_kos'],
            'fasilitas' => $fasilitas,
            'penyewaan' => $penyewaan,
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
            "role" => $user['role'],
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
                'waktu_penyewaan' => $_POST['penyewaan'],
                'alamat' => $_POST['alamat'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'id_kos' => $idKos
            ];

            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $idKos . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Insert kos data into the database
            $kosId = $this->KosModel->tambahDataKos($kosData);

            if ($kosId > 0) {
                if (isset($_FILES['foto_depan']) && $_FILES['foto_depan']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['foto_depan']['tmp_name'];
                    $newFileName = 'foto_depan.jpg';
                    $targetFilePath = $uploadDir . $newFileName;

                    if (file_exists($targetFilePath)) {
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
            } else if ($_FILES) {
                if (isset($_FILES['foto_depan']) && $_FILES['foto_depan']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['foto_depan']['tmp_name'];
                    $newFileName = 'foto_depan.jpg';
                    $targetFilePath = $uploadDir . $newFileName;

                    if (file_exists($targetFilePath)) {
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


        $id_user = $_SESSION['user']['id_user'];
        $id_kos = $_SESSION['user']['id_kos'];
        $user = $this->model('UsersModel')->findUserById($id_user);
        $kamar = $this->KosModel->getDataKamar($id_kos);
        $array = $kamar['jenis_fasilitas'] ?? null;
        $fasilitas = explode(',', $array);
        $array_penyewaan = $kamar['waktu_sewa'] ?? null;
        $penyewaan = explode(',', $array_penyewaan);
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $imagePath = $baseDir .  $id_kos;

        $layout = [
            'data' => $kamar,
            'fasilitas' => $fasilitas,
            'imagePath' => $imagePath,
            'penyewaan' => $penyewaan,
            'id_kos' => $id_kos
        ];

        ob_start();
        $this->view('data_kos/formkamar', $layout);
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKamar",
            "role" => $user['role'],
            "id_gambar" => $user['id_gambar'],
            "id_user" => $id_user
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
            $id_kos = $_SESSION['user']['id_kos'];


            $KamarData = [
                'luas_kamar' => $_POST['luas_kamar'],
                'jenis_fasilitas' => $_POST['fasilitas'],
                'harga_bulan' => $_POST['harga_bulan'],
                'kamar_tersedia' => $_POST['kamar_tersedia'],
                'tipe_kamar' => $_POST['tipe_kamar'],
                'total_kamar' => $_POST['total_kamar'],
                'harga_minggu' => $_POST['harga_minggu'],
                'harga_hari' => $_POST['harga_hari'],
                'id_kos' => $id_kos
            ];

            $fileMappings = [
                'kamar-depan' => 'kamar-depan',
                'kamar-kamar_mandi' => 'kamar-kamar_mandi',
                'kamar-dalam' => 'kamar-dalam',
                'kamar-lain' => 'kamar-lain',
            ];

            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $uploadDir = $baseDir . $id_kos . '/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $kamarid = $this->KosModel->tambahDataKamar($KamarData);

            if ($kamarid > 0) {
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
