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
                // Convert route URI to a regex pattern with optional trailing slash
                $routePattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $route);
                $routePattern = str_replace('/', '\/', $routePattern);
                $routePattern = '/^' . $routePattern . '\/?$/'; // Allow optional trailing slash

                if (preg_match($routePattern, $uri, $matches)) {
                    array_shift($matches); // Remove the full match

                    if (is_callable($action)) {
                        call_user_func_array($action, $matches);
                    } else if (is_string($action)) {
                        self::callControllerAction($action, $matches);
                    }
                    return;
                }
            }
        }

        // If no route matches, redirect to the home route or handle 404
        header('Content-Type: application/json', true, 404);
        echo json_encode(['status' => 'error', 'message' => 'Route not found']);
        header('Location: /web_rekost/');
        exit();
    }







    public static function getUri()
    {

        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


        $baseDir = 'web_rekost';
        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        return $uri ?: '/';
    }

    private static function callControllerAction($action, $params = [])
{
    list($controller, $method) = explode('@', $action);

    // Detect if this is an API route by checking if the URI starts with /api/
    $isApiRoute = strpos(self::getUri(), '/api') === 0;

    // Set the controller directory based on route type
    $controllerDir = $isApiRoute ? './app/controllers/api' : './app/controllers/web';
    $controller = ucfirst($controller);
    $controllerFile = "$controllerDir/$controller.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        
        // Cek apakah controller membutuhkan parameter di konstruktor
        if (class_exists($controller)) {
            // Misalnya, jika controller memerlukan koneksi database
            if (method_exists($controller, '__construct')) {
                $controllerInstance = new $controller($GLOBALS['conn']); // Mengirimkan $conn ke konstruktor
            } else {
                $controllerInstance = new $controller();
            }

            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                echo "Method $method not found in controller $controller.";
            }
        } else {
            echo "Controller $controller not found.";
        }
    } else {
        echo "Controller file $controllerFile not found.";
    }
}
}