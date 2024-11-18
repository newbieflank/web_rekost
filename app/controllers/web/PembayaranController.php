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
}
