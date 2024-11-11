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

    public function getProfileImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];
            $user = $this->model('UsersModel')->findUserById($userId);
            if (!isset($user['id_gambar'])) {
                $imageFile = BASEURL . 'public/img/Vector.svg';
                header("Content-Type: image/*");
                header("Content-Length: " . filesize($imageFile));

                readfile($imageFile);
                exit;
            }

            // Define the path where user images are stored
            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
            $userDir = $baseDir . $userId . '/';


            if (is_dir($userDir)) {

                $imageFiles = glob($userDir . "*.png");
                if (!empty($imageFiles)) {
                    $imageFilePath = $imageFiles[0];

                    header("Content-Type: image/*");
                    header("Content-Length: " . filesize($imageFilePath));

                    readfile($imageFilePath);
                    exit;
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
        } else {
            // user_id not provided
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(["success" => false, "message" => "No user_id provided."]);
            exit;
        }
    }
}
