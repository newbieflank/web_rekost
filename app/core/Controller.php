<?php

class Controller
{


    protected function view($view, $data = [])
    {

        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    protected function header($route)
    {
        header('Location: http://localhost/web_rekost/public' . $route);
    }
}
