<?php

class KosController extends Controller
{

    private $kos;

    public function __construct()
    {
        $this->kos = $this->model('KosModel');
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
}
