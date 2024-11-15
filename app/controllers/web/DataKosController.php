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
        $kos = $this->KosModel->getData($_SESSION['user']['id_kos']);

        $dataKos = [
            'namaKos' => $kos['nama_kos'],
            'deskripsi' => $kos['deskripsi'],
            'tipe' => $kos['tipe_kos'],
            'alamat' => $kos['alamat'],
            'peraturan' => $kos['peraturan_kos'],
            'fasilitas' => $kos['jenis_fasilitas'],
            'latitude' => $kos['latitude'],
            'longitude' => $kos['longitude']
        ];

        ob_start();
        $this->view('data_kos/formkos', $dataKos);
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",
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
            $userId = $_SESSION['user']['id_kos'];

            $kosData = [
                'nama_kos' => $_POST['nama_kos'],
                'deskripsi' => $_POST['deskripsi'],
                'tipe_kos' => $_POST['tipekos'],
                'peraturan_kos' => $_POST['peraturan'],
                'jenis_fasilitas' => $_POST['fasilitas'],
                'alamat' => $_POST['alamat'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'id_kos' => $userId
            ];

            // Insert kos data into the database
            $kosId = $this->KosModel->tambahDataKos($kosData);

            if ($kosId > 0) {
                $response = ['success' => true, 'message' => 'Data kos berhasil ditambahkan'];
                // $this->header('/datakos');
            } else {
                $response = ['success' => false, 'message' => 'Gagal menambahkan data kos', $kosData];
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

            -

                $kamarid = $this->KosModel->tambahDataKamar($KamarData);

            if ($kamarid > 0) {
                $response = ['success' => true, 'message' => 'Data kamar berhasil ditambahkan', $KamarData];
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
