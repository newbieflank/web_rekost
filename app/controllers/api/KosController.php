<?php

class KosController extends Controller
{

    private $kos;

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
        echo json_encode(['data' => $user,'status' => 'success' ]);
    }

    public function getDetailKos($id){
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
}
