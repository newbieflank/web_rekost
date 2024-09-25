<?php

if (!session_start()) {
    session_start();
}

require_once '../config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Router.php';
require_once '../app/core/View.php';
require_once '../app/Helpers/Response.php';
require_once '../app/MiddleWare/AuthMiddleware.php';

$app = new App();
