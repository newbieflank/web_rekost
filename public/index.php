<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once '../config/config.php';
require_once '../vendor/autoload.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';
require_once '../app/core/Router.php';
require_once '../app/core/View.php';
require_once '../app/core/App.php';


$app = new App();
