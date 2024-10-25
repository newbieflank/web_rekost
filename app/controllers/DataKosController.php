<?php

class DataKosController extends Controller
{

    public function index()
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
}