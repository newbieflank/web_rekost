<?php

class LoginController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UsersModel');
    }

    public function login()
    {
        $this->view('Login/login');
    }


    public function register()
    {
        $this->view('Login/register');
    }

    public function auth()
    {
        $email = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->getProfile($email, $password);
        if (isset($user['id_user'])) {
            if ($user['role'] === 'pemilik kos') {

                $data = $this->userModel->findOwnerById($user['id_user']);
                $data = [
                    "id_user" => $user['id_user'],
                    "email" => $user['email'],
                    "role" => $user['role'],
                    "id_kos" => $data['id_kos']
                ];

                if (isset($_POST['remember'])) {
                    setcookie("user", json_encode($data), time() + (86400 * 30), "/", "", true);
                    $this->header('/');
                    exit();
                }

                $_SESSION['user'] = $data;
            } else {
                $user = [
                    "id_user" => $user['id_user'],
                    "email" => $user['email'],
                    "role" => $user['role']
                ];

                if (isset($_POST['remember'])) {
                    setcookie("user", json_encode($user), time() + (86400 * 30), "/", "", true);
                    $this->header('/');
                    exit();
                }

                $_SESSION['user'] = $user;
            }

            $this->header('/');
            exit();
        } else {
            if ($this->userModel->findUserByEmail($email)) {
                Flasher::setFlash('*Password Salah', 'danger');
                $this->header('/login');
                exit();
            } else {
                Flasher::setFlash('*Akun Tidak di Temukan', 'danger');
                $this->header('/login');
                exit();
            }
        }
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();
        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                'user',
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }


        $this->header('/');
        exit();
    }

    public function create()
    {
        do {
            $id = $this->generateRandomId();
            $cekID = $this->userModel->findUserById($id);
        } while ($cekID);

        $username = $_POST['fullname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if ($this->userModel->findUserByEmail($email)) {
            Flasher::setFlash('*Akun Email Sudah Terdaftar', 'danger');
            $this->header('/register');
            exit();
        }

        if ($role === 'pemilik kos') {
            $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
            $kosID = $id . $randomNumber;

            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => $number,
                'password' => $password,
                'role' => $role,
                'id_kos' => $kosID
            ];

            if ($this->userModel->pemilik($data) > 0) {
               if ($this->userModel->createKos($data['id_kos'], $data['id']) > 0) {
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],
                    "email" => $data['email'],
                    "role" => $data['role'],
                    "id_kos" => $data['id_kos']
                ];

                $this->header('/');
                exit();
                } else {
                    echo json_encode($data);
                }
            } else {
                Flasher::setFlash('*Gagal Membuat Akun', 'danger');
                $this->header('/register');
                exit();
            }
        } else {
            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => $number,
                'password' => $password,
                'role' => $role
            ];


            if ($this->userModel->create($data) > 0) {
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id_user'],
                    "email" => $data['email'],
                    "role" => $data['role']
                ];

                $this->header('/');
                exit();
            } else {
                Flasher::setFlash('*Pastikan Semua Data Terisi Dengan Benar', 'danger');
                $this->header('/register');
                exit();
            }
        }
    }

    public function Google()
    {

        do {
            $id = $this->generateRandomId();
            $cekID = $this->userModel->findUserById($id);
        } while ($cekID);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['Password'];
        $confirm = $_POST['confirmPassword'];

        // Validate password
        if ($password !== $confirm) {
            Flasher::setFlash('Password Tidak Cocok', 'danger');
            $this->header('/setpassword');
            exit();
        } elseif (strlen($password) < 8) {
            Flasher::setFlash('Password Minimal 8 Character', 'danger');
            $this->header('/setpassword');
            exit();
        }

        if ($role === 'pemilik kos') {
            $randomNumber = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
            $kosID = $id . $randomNumber;

            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => null,
                'password' => $password,
                'role' => $role,
                'id_kos' => $kosID
            ];

            if ($this->userModel->pemilik($data) > 0) {
                if ($this->userModel->createKos($data['id_kos'], $data['id']) > 0) {
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],
                    "email" => $data['email'],
                    "role" => $data['role'],
                    "id_kos" => $data['id_kos']
                ];

                $this->header('/');
                exit();
                } else {
                    echo json_encode($data);
                }
            } else {
                Flasher::setFlash('*Pastikan Semua Data Terisi Dengan Benar', 'danger');
                $this->header('/register');
                exit();
            }
        } else {
            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => null,
                'password' => $password,
                'role' => $role
            ];


            if ($this->userModel->createG($data) > 0) {
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],
                    "email" => $data['email'],
                    "role" => $data['role']
                ];

                $this->header('/');
                exit();
            } else {
                Flasher::setFlash('*Pastikan Semua Data Terisi Dengan Benar', 'danger');
                $this->header('/register');
                exit();
            }
        }
    }

    private function generateRandomId()
    {

        $dateTime = date('Ym'); // This gives you 12 characters (YYYYMMDDHHMM)


        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;
        return $generatedId;
    }
}
