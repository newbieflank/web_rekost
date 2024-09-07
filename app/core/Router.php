<?php

class Router
{
    private static $routes = [];

    public static function __callStatic($method, $args)
    {
        if (in_array(strtoupper($method), ['GET', 'POST'])) {
            $uri = $args[0];
            $action = $args[1];
            self::$routes[strtoupper($method)][$uri] = $action;
            self::handleDispatch();
        } else {
            throw new \BadMethodCallException("Method $method not supported.");
        }
    }

    private static function handleDispatch()
    {
        $uri = self::getUri();
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $route => $action) {
                // Convert route URI to a regex pattern
                $routePattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $route);
                $routePattern = str_replace('/', '\/', $routePattern);
                if (preg_match('/^' . $routePattern . '$/', $uri, $matches)) {
                    array_shift($matches);

                    if (is_callable($action)) {
                        call_user_func_array($action, $matches);
                    } else if (is_string($action)) {
                        self::callControllerAction($action, $matches);
                    }

                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 - Not Found";
    }

    public static function getUri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $baseDir = 'web_rekost/public';

        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

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
                call_user_func_array([$controllerInstance, $method], $params); // Pass parameters to the method
            } else {
                echo "Method $method not found in controller $controller.";
            }
        } else {
            echo "Controller $controller not found.";
        }
    }
}
