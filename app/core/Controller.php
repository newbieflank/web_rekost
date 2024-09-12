<?php

class Controller
{
    private $baseURL;

    public function __construct()
    {
        $this->baseURL = "http://localhost/web_rekost/public/";
    }
    public function view($view, $data = [])
    {
        $data['baseURL'] = $this->baseURL;

        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
}
