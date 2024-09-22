<?php

class Controller
{
    private $baseURL;


    public function view($view, $data = [])
    {
        $data['baseURL'] = $this->baseURL;

        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}
