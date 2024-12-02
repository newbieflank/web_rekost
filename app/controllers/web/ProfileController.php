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
        if (!isset($_SESSION['user']['email'])) {
            die("User not logged in.");
        }

        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $tanggal = DateTime::createFromFormat('Y-m-d', $user['tanggal_lahir']);
        $formattedTanggal = $tanggal ? $tanggal->format('d-F-Y') : null;

        ob_start();
        $role = $this->getRole();

        if ($role === 'pencari kos') {


            $userData = [
                "id_user" => $user['id_user'],
                "username" => $user['nama'],
                "gender" => $user['jenis_kelamin'],
                "pekerjaan" => $user['pekerjaan'],
                "tanggal" => $formattedTanggal,
                "instansi" => $user['Instansi'],
                "kota" => $user['kota_asal'],
                "nomor" => $user['number_phone'],
                "status" => $user['status'],
                "alamat" => $user['alamat'],
                "id_gambar" => $user['id_gambar']

            ];
            $this->renderProfile('profile/profile', 'Profile', $userData);
        } else {
            $kost = $this->userModel->findKost($_SESSION['user']['id_user']);
            if (!$kost) {
                $namaKost = '';
            } else {
                $namaKost = $kost['nama_kos'];
            }

            $userData = [
                "id_user" => $user['id_user'],
                "username" => $user['nama'],
                "gender" => $user['jenis_kelamin'],
                "pekerjaan" => $user['pekerjaan'],
                "tanggal" => $formattedTanggal,
                "instansi" => $user['Instansi'],
                "kota" => $user['kota_asal'],
                "nomor" => $user['number_phone'],
                "status" => $user['status'],
                "alamat" => $user['alamat'],
                "id_gambar" => $user['id_gambar'],
                "kost" => $namaKost
            ];
            $this->renderProfile('profile/profileKost', 'Profile', $userData);
        }
    }

    private function renderProfile($viewPath, $pageTitle, $data = [])
    {
        $email = $_SESSION['user']['email'];
        $user = $this->model('UsersModel')->findUserByEmail($email);

        ob_start();
        $this->view($viewPath, $data);
        $content = ob_get_clean();

        $layoutData = [
            "content" => $content,
            "title" => $pageTitle,
            "role" => $user['role'],
            "id_user" => $user['id_user'],
            "id_gambar" => $user['id_gambar'],
            "footer" => false
        ];

        // echo $role = $this->getRole();

        $this->view('layout/main', $layoutData);
    }

    public function update()
    {
        // echo json_encode($_POST);
        // die;

        if ($this->model('UsersModel')->updateProfile($_POST) > 0) {
            $this->header('/profile');
            exit;
        } else {
            echo 'error';
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
