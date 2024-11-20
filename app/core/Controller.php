<?php

class Controller
{
    // Fungsi untuk memuat view
    protected function view($view, $data = [])
    {
        extract($data);
        require_once './app/views/' . $view . '.php';
    }

    // Fungsi untuk memuat model
    protected function model($model)
    {
        require_once './app/models/' . $model . '.php';
        return new $model;
    }

    // Fungsi untuk mengarahkan halaman
    protected function header($route, $data = [])
    {
        header('Location: http://localhost/web_rekost' . $route);
    }

    // Fungsi untuk memuat helper
    protected function helper($helper)
    {
        $helperPath = './helpers/' . $helper . '.php';

        // Memeriksa apakah file helper ada
        if (file_exists($helperPath)) {
            require_once $helperPath;
        } else {
            throw new Exception("Helper file {$helper}.php not found.");
        }
    }

    // Fungsi untuk memuat model dengan pengecekan file
    protected function loadModel($model)
    {
        // Memastikan file model ada
        $modelPath = './app/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            throw new Exception("Model {$model}.php not found.");
        }
    }

    // Fungsi untuk memuat beberapa model sekaligus
    protected function loadModels($models)
    {
        $loadedModels = [];
        foreach ($models as $model) {
            $loadedModels[] = $this->loadModel($model);
        }
        return $loadedModels;
    }
}
