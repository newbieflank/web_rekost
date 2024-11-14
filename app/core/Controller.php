<?php

class Controller
{


    protected function view($view, $data = [])
    {

        extract($data);
        require_once './app/views/' . $view . '.php';
    }

    protected function model($model)
    {
        require_once './app/models/' . $model . '.php';
        return new $model;
    }

    protected function header($route, $data = [])
    {
        header('Location:' . BASEURL . $route);
    }

    protected function helper($helper)
    {
        $helperPath = './helpers/' . $helper . '.php';

        // Check if the helper file exists before requiring it
        if (file_exists($helperPath)) {
            require_once $helperPath;
        } else {
            throw new Exception("Helper file {$helper}.php not found.");
        }
    }
}
