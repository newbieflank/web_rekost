<?php

class DataKosController extends Controller
{

    public function datakos()
    {
        ob_start();
        $this->view('data_kos/DataKos');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function fasilitas()
    {
        ob_start();
        $this->view('data_kos/Fasilitaskos');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function alamat()
    {
        ob_start();
        $this->view('data_kos/Alamatkos');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function fotokmr()
    {
        ob_start();
        $this->view('data_kos/Fotokamar');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function harga()
    {
        ob_start();
        $this->view('data_kos/Harga');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function fotokos()
    {
        ob_start();
        $this->view('data_kos/Fotokos');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function ke()
    {
        ob_start();
        $this->view('data_kos/KetersediaanKamar');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }

    public function ke2()
    {
        ob_start();
        $this->view('data_kos/KetersediaanKamar2');

        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "DataKos",

        ];

        $this->view('layout/main', $data);
    }
}