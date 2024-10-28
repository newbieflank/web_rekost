<?php
class ProfileController extends Controller
{
    private $user;
    private $userModel;
    private $ImageModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }

        $this->userModel = $this->model('UsersModel');
        $this->ImageModel = $this->model('ImageModel');
    }

    public function getRole()
    {
        $user = $_SESSION['user'];

        // Check if $user is an array and contains the 'role' key
        if (is_array($user) && isset($user['role'])) {
            return $user['role'];
        }

        return null;
    }

    public function profile()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->model('UsersModel')->findUserByEmail($email);

        ob_start();
        $role = $this->getRole();

        if ($role === 'pencari kos') {
            $tanggal = DateTime::createFromFormat('Y-m-d', $user['tanggal_lahir']);
            $formattedTanggal = $tanggal ? $tanggal->format('d-F-Y') : null;

            $userData = [
                "username" => $user['nama'],
                "gender" => $user['jenis_kelamin'],
                "pekerjaan" => $user['pekerjaan'],
                "tanggal" => $formattedTanggal,
                "instansi" => $user['Instansi'],
                "kota" => $user['kota_asal'],
                "nomor" => $user['number_phone']

            ];
            // echo json_encode($userData);
            $this->renderProfile('profile/profile', 'Profile', $userData);
        } else {
            $this->renderProfile('profile/profileKost', 'Profile');
        }
    }

    private function renderProfile($viewPath, $pageTitle, $data = [])
    {
        ob_start();
        $this->view($viewPath, $data);
        $content = ob_get_clean();

        $layoutData = [
            "content" => $content,
            "title" => $pageTitle,
        ];

        // echo $role = $this->getRole();

        $this->view('layout/main', $layoutData);
    }

    public function update()
    {
        if ($this->model('UsersModel')->updateProfile($_POST) > 0) {
            $this->header('/profile');
            exit;
        } else {
            echo 'error';
        }
    }

    public function upload()
    {
        // $image = $_FILES['profileImage']['tmp_name'];
        // $imageId = $this->IdMaker();

        // // Read the image file
        // $imageContent = file_get_contents($image);
        // if ($imageContent === false) {
        //     die("Failed to read image file.");
        // }

        // if ($_FILES['profileImage']['error'] !== UPLOAD_ERR_OK) {
        //     die("Upload failed with error code " . $_FILES['profileImage']['error']);
        // }

        // if ($this->model('ImageModel')->insert($imageId, $image) > 0) {
        //     $this->header('/profile');
        //     exit;
        // } else {
        //     echo "Kholit Kontol";
        // }

        $id = $this->ImageModel->getId($_SESSION['user']['id_user']);

        $targetDir = '../../public/asset/';
        $previousFile = $id;

        if (isset($_POST['file'])) {
            $result = FileUploadHelper::uploadFile($_FILES['file'], $targetDir, $previousFile);

            if ($result['status']) {
                // Update the session or database with the new file path
                $_SESSION['uploaded_file'] = $result['filePath'];
                echo $result['message'];
            } else {
                echo $result['message'];
            }
        } else {
            echo "Error: No file uploaded.";
        }
    }

    private function IdMaker()
    {
        $id = $_SESSION['user']['id_user'];

        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $ID = $id + $randomNumber;

        return $ID;
    }
}
