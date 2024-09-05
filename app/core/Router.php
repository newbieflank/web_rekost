<?php

class Router
{
    private static $routes = [];

    public static function get($uri, $action)
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch()
    {
        $uri = self::getUri();
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(self::$routes[$method][$uri])) {
            $action = self::$routes[$method][$uri];

            if (is_callable($action)) {
                call_user_func($action);
            } else if (is_string($action)) {
                self::callControllerAction($action);
            }
        } else {
            http_response_code(404);
            echo "404 - Not Found";
        }
    }

    public static function getUri()
    {

        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $baseDir = 'rekost_web/public';

        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        return $uri ?: '/';
    }



    // Call the controller action
    private static function callControllerAction($action)
    {
        list($controller, $method) = explode('@', $action);
        $controller = ucfirst($controller);
        $controllerFile = "../app/controllers/$controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], []);
            } else {
                echo "Method $method not found in controller $controller.";
            }
        } else {
            echo "Controller $controller not found.";
        }
    }
}
