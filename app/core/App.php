<?php


class App
{
    public function __construct()
    {
        // Load routes
        require_once '../routes/web.php';

        // Dispatch the current route
        Router::dispatch();
    }
}
