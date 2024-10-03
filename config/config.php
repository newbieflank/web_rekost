<?php

define('BASEURL', 'http://localhost/web_rekost/public/');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rekost');

function redirect($route)
{
    header('Location: http://localhost/web_rekost/public');
}
