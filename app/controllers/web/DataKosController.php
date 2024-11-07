<?php

class DataKosController extends Controller
{

    public function datakos()
    {
        ob_start();
        $this->view('data_kos/newform');

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

    public function tambah()
    {

        if ($this->model('KosModel')->tambahDataKos($_POST) > 0);
        $this->header('/datakos');
        exit;
    }

    public function tambahFasilitas()
    {
        if ($this->model('KosModel')->updateFasilitas($_POST) > 0) {
            header('Location: ' . BASEURL . '/alamatkos');
            exit;
        } else {
            header('Location: ' . BASEURL . '/fasilitaskos');
            exit;
        }
    }
    public function tambahAlamat()
    {
        if ($this->model('KosModel')->updateAlamat($_POST) > 0) {
            header('Location: ' . BASEURL . '/fotokos');
            exit;
        } else {
            header('Location: ' . BASEURL . '/alamatkos');
            exit;
        }
    }

    public function tambahHarga()
    {
        if ($this->model('KosModel')->updateHarga($_POST) > 0) {
            header('Location: ' . BASEURL . '/fotokamar');
            exit;
        } else {
            header('Location: ' . BASEURL . '/harga');
            exit;
        }
    }
}
