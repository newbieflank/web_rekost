<?php

class UserController extends Controller
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

            if ($user['role'] === 'pemilik kos') {
                $data = $this->model('UsersModel')->findOwnerById($user['id_user']);
                $response = [
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        "id" => $user['id_user'],
                        "email" => $user['email'],
                        "role" => $user['role'],
                        "id_kos" => $data['id_kos']
                    ],
                ];
            } else {
                // For demonstration, let's assume a successful login scenario
                $response = [
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        'email' => $user['email'],
                        'id' => $user['id_user'],
                        'role' => $user['role'],
                        'id_kos' => null
                    ],
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Email or password missing',
            ];
        }

        echo json_encode($response);
    }

    public function getProfileImage($id)
    {

        $userId = $id;
        $user = $this->model('UsersModel')->findUserById($userId);
        if (!isset($user['id_gambar'])) {
            $imageFile = BASEURL . 'public/img/logo.png';
            $imageData = file_get_contents($imageFile); // Get image content as binary data
            header("Content-Type: image/png"); // Set appropriate content type for SVG
            echo $imageData; // Output image contentFile);
            return;
        }

        // Define the path where user images are stored
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $userDir = $baseDir . $userId . '/';


        if (is_dir($userDir)) {

            $imageFiles = glob($userDir . "*.png");
            if (!empty($imageFiles)) {
                $imageFilePath = $imageFiles[0];

                header("Content-Type: image/png");
                header("Content-Length: " . filesize($imageFilePath));

                readfile($imageFilePath);
                return;
            } else {
                header("HTTP/1.0 404 Not Found");
                echo json_encode(["success" => false, "message" => "No image found for this user."]);
                exit;
            }
        } else {
            // User directory does not exist
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["success" => false, "message" => "User directory does not exist."]);
            exit;
        }
    }

    public function user($id)
    {
        // header("Access-Control-Allow-Origin: *");
        // header('Content-Type: application/json');
        $user = $this->user->findUserById($id);

        if ($user) {
            $response = [
                'status' => 'success',
                'message' => 'Data Berhasil Di Dapat',
                'data' => [
                    'id_user' => $id,
                    'email' => $user['email']
                ]
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Email or password missing',
            ];
        }

        echo json_encode($response);
    }

    public function getDataUser() {}
}
