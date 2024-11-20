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

        // Periksa apakah metode request ada dalam rute yang terdaftar
        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $route => $action) {
                // Convert route URI ke pola regex dengan parameter dinamis
                $routePattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $route);
                $routePattern = str_replace('/', '\/', $routePattern);
                $routePattern = '/^' . $routePattern . '\/?$/'; // Allow optional trailing slash

                if (preg_match($routePattern, $uri, $matches)) {
                    array_shift($matches); // Hapus hasil pencocokan pertama (URI lengkap)

                    if (is_callable($action)) {
                        call_user_func_array($action, $matches);
                    } else if (is_string($action)) {
                        self::callControllerAction($action, $matches);
                    }
                    return;
                }
            }
        }

        // Menangani response 404 dengan pesan JSON dan redirect ke halaman utama
        header('Content-Type: application/json', true, 404);
        echo json_encode(['status' => 'error', 'message' => 'Route not found']);
        header('Location: /web_rekost/');
        exit();
    }

    // Mengambil URI dari request
    public static function getUri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Jika aplikasi berada dalam subdirektori, kita harus menyesuaikan URI
        $baseDir = 'web_rekost';
        if (strpos($uri, $baseDir) === 0) {
            $uri = substr($uri, strlen($baseDir));
        }

        return $uri ?: '/';
    }

    // Memanggil controller dan method berdasarkan route yang cocok
    private static function callControllerAction($action, $params = [])
    {
        list($controller, $method) = explode('@', $action);

        // Tentukan apakah ini rute API berdasarkan URI
        $isApiRoute = strpos(self::getUri(), '/api') === 0;

        // Tentukan direktori controller berdasarkan tipe rute
        $controllerDir = $isApiRoute ? './app/controllers/api' : './app/controllers/web';
        $controller = ucfirst($controller);
        $controllerFile = "$controllerDir/$controller.php";

        // Pastikan file controller ada
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            // Periksa apakah class controller ada
            if (class_exists($controller)) {
                $controllerInstance = new $controller();

                // Periksa apakah method ada di controller
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $params);
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Method $method not found in controller $controller."]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => "Controller $controller not found."]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "Controller file $controllerFile not found."]);
        }
    }
}
