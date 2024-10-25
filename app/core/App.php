<?php


class App
{
    public function __construct()
    {       
        require_once '../routes/web.php';

        Router::dispatch();
    }
}
