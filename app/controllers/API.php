<?php

class API extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = $this->model('UsersModel');
    }

    public function getProfile()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data['email'] ?? null;
        $user = $this->user->findUserByEmail($email);

        echo json_encode($user);
    }



    public function login()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        // Retrieve JSON data sent to the API
        $data = json_decode(file_get_contents("php://input"), true);

        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        $user = $this->model('UsersModel')->getProfile($email, $password);
        if (isset($user)) {
            // For demonstration, let's assume a successful login scenario
            $response = [
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'email' => $user['email'],
                    'id' => $user['id_user'],
                    'role' => $user['role']
                ],
            ];
        } else {
            // Handle error
            $response = [
                'status' => 'error',
                'message' => 'Email or password missing',
            ];
        }

        error_log(json_encode($response));
        echo json_encode($response);
    }

    public function getProfileImage($userId)
    {
        // Define the path to your image folder
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/2024105278/';
        $imageFile = $imagePath . $userId . ".png";

        if (file_exists($imageFile)) {

            header('Content-Type: image/png');
            header('Content-Length: ' . filesize($imageFile));
            readfile($imageFile);

            // echo json_encode(['status' => 'done', 'message' => 'Image found']);

            exit();
        } else {
            // Image not found, return an error response
            header('Content-Type: application/json', true, 404);
            echo json_encode(['status' => 'error', 'message' => 'Image not found']);
            exit();
        }
    }
}
