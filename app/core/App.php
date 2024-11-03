<?php


class App
{
    public function __construct()
    {
        require_once './routes/web.php';
        require_once './routes/api.php';

        try {
            Router::dispatch();
        } catch (Exception $e) {
            $this->handleApiError($e);
        }
    }

    private function handleApiError(Exception $e)
    {
        header('Content-Type: application/json', true, 500);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
        ]);
        exit();
    }
}
