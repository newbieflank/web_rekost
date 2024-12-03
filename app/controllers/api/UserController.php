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
            $imageData = file_get_contents($imageFile);
            header("Content-Type: image/png");
            readfile($imageFile);
            return;
        }

        // Define the path where user images are stored
        $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/web_rekost/public/uploads/';
        $userDir = $baseDir . $userId . '/';


        if (is_dir($userDir)) {
            $imageFiles = $userDir . $user['id_gambar'];
            if (file_exists($imageFiles)) {

                header("Content-Type: image/jpg");
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

        $data = json_decode(file_get_contents("php://input"), true);

        do {
            $id = $this->generateRandomId();
            $cekID = $this->user->findUserById($id);
        } while ($cekID);

        if ($data['role'] === ['pemilik kos']) {
            do {
                $idKos = $this->generateRandomId();
                $cekID = $this->user->findKosById($idKos);
            } while ($cekID);

            $pemilik = $this->user->pemilik($data);

            if ($pemilik > 0) {
                if ($this->user->createKos($idKos, $id) > 0) {
                    $response = [
                        "status" => 'success',
                        "message" => 'user berhasil di tambahkan'
                    ];
                } else {
                    $response = [
                        "status" => 'failed',
                        "message" => 'data Kos gagal di tambahkan'
                    ];
                }
            } else {
                $response = [
                    "status" => 'failed',
                    "message" => 'user gagal di tambahkan'
                ];
            }
        } else {
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
        }

        echo json_encode($response);
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
