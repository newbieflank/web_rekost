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
        if ($user) {
            if ($user['role'] === 'pemilik kos') {
                $response = [
                    'status' => 'error',
                    'message' => 'Pastikan status anda sebagai Pencari kos',
                ];
            } else {
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
                'message' => 'Email atau password salah',
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
            $imageData = file_get_contents($imageFile);
            header("Content-Type: image/png");
            readfile($imageFile);
            return;
        }

        // Define the path where user images are stored
        $userDir = uploads($userId . '/');


        if (is_dir($userDir)) {
            $imageFiles = $userDir . $user['id_gambar'];
            if (file_exists($imageFiles)) {

                header("Content-Type: image/*");
                header("Content-Length: " . filesize($imageFiles));

                readfile($imageFiles);
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

    public function register()
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        $json = json_decode(file_get_contents("php://input"), true);

        do {
            $id = $this->generateRandomId();
            $cekID = $this->user->findUserById($id);
        } while ($cekID);

        $data = [
            "id" => $id,
            "username" => $json['username'],
            "email" => $json['email'],
            "password" => $json['password'],
            "number" => intval($json['number']),
            "role" => 'pencari kos'
        ];

        if ($this->user->create($data) > 0) {
            $this->user->insert($id, 'aktif');
            $response = [
                "status" => 'success',
                "message" => 'user berhasil di tambahkan'
            ];
        } else {
            $response = [
                "status" => 'failed',
                "message" => 'user gagal di tambahkan'
            ];
        }

        echo json_encode($response);
    }

    public function user($id)
    {
        $user = $this->user->findUserById($id);
        if ($user) {
            $response = [
                'status' => 'success',
                'message' => 'Data Berhasil Di Dapat',
                'data' => [
                    'id_user' => $id,
                    'id_gambar' => $user["id_gambar"],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'jenis_kelamin' => $user['jenis_kelamin'],
                    'tanggal_lahir' => $user['tanggal_lahir'],
                    'pekerjaan' => $user['pekerjaan'],
                    'Instansi' => $user['Instansi'],
                    'alamat' => $user['alamat'],
                    'number_phone' => $user['number_phone']
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

    public function updateUser()
    {

        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        // Retrieve JSON data sent to the API
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid input data"
            ]);
            return;
        }

        // Panggil fungsi untuk update profile
        $user = $this->user->updateProfile($data);

        if ($user > 0) {
            echo json_encode([
                "status" => "success",
                "message" => "User profile updated successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to update user profile. No changes made or invalid user."
            ]);
        }

        // echo json_encode($data);

    }


    public function getDataUser() {}

    private function generateRandomId()
    {

        $dateTime = date('Ym');


        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;
        return $generatedId;
    }
}
