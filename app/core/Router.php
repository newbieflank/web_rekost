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


        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $route => $action) {
                // Convert route URI to a regex pattern
                $routePattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $route);
                $routePattern = str_replace('/', '\/', $routePattern);

                if (preg_match('/^' . $routePattern . '$/', $uri, $matches)) {
                    array_shift($matches); // Remove the first element which is the full match

                    if (is_callable($action)) {
                        call_user_func_array($action, $matches);
                    } else if (is_string($action)) {
                        self::callControllerAction($action, $matches);
                    }

                    return;
                }
            } //
        }
        header('Location: /web_rekost/public/');
        exit();
    }



    public static function getUri()
    {

        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


        $baseDir = 'web_rekost/public';


        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        $uri = str_replace("public", "", $uri);
        return $uri ?: '/';
    }


    private static function callControllerAction($action, $params = [])
    {
        list($controller, $method) = explode('@', $action);
        $controller = ucfirst($controller);
        $controllerFile = "../app/controllers/$controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                echo "Method $method not found in controller $controller.";
            }
        } else {
            echo "Controller $controller not found.";
        }
    }
}
