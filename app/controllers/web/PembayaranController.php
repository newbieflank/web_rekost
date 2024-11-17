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
        // var_dump($kos);
        // die;
        $this->view('pembayaran/konfirmasi', [
            'kos' => $kos
        ]);
    }
}
