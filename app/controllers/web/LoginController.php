<?php

class LoginController extends Controller
{

    public $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UsersModel');
    }

    public function login()
    {
        $this->view('login/login');
    }


    public function register()
    {
        $this->view('login/register');
    }

    public function auth()
    {

        $email = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->getProfile($email, $password);
        if (isset($user['id_user'])) {
            $this->userModel->updateUserStatus($user['id_user'], 'online');
            if ($user['role'] === 'pemilik kos') {
                $_SESSION['new'] = false;

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
                $this->header('/');
                exit();
            } else {
                $user = [
                    "id_user" => $user['id_user'],
                    "email" => $user['email'],
                    "role" => $user['role']
                ];
                $_SESSION['new'] = false;
                if (isset($_POST['remember'])) {
                    setcookie("user", json_encode($user), time() + (86400 * 30), "/", "", true);
                    $this->header('/');
                    exit();
                }

                $_SESSION['user'] = $user;
                $this->header('/');
                exit();
            }
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
            do {
                $idKos = $this->generateRandomId();
                $cekID = $this->userModel->findKosById($idKos);
            } while ($cekID);

            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => $number,
                'password' => $password,
                'role' => $role,
                'id_kos' => $idKos
            ];

            if ($this->userModel->pemilik($data) > 0) {
                if ($this->userModel->createKos($data['id_kos'], $id) > 0 && $this->userModel->createKamar($data['id_kos']) > 0) {
                    $_SESSION['user'] = [
                        "id_user" => $data['id'],
                        "email" => $data['email'],
                        "role" => $data['role'],
                        "id_kos" => $data['id_kos']
                    ];

                    $this->view('login/verifpemilik', $data);
                    exit();
                } else {
                    echo json_encode($data['id_kos'], $data['id']);
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


            if ($this->userModel->create($data) > 0) {
                $this->userModel->insert($id, 'aktif');
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],
                    "email" => $data['email'],
                    "role" => $data['role']
                ];
                $_SESSION['new'] = true;
                $this->header('/profile');
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
        $password = $_POST['Password'];
        $confirm = $_POST['confirmPassword'];

        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        } else {
            $role = null;
        }


        $data1 = [
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];
        // Validate password
        if ($password !== $confirm) {
            Flasher::setFlash('Password Tidak Cocok', 'danger');
            $this->view('login/setpassword', $data1);
            exit();
        } elseif (strlen($password) < 8) {
            Flasher::setFlash('Password Minimal 8 Character', 'danger');
            $this->view('login/setpassword', $data1);
            exit();
        }

        if ($role === 'pemilik kos') {
            do {
                $idKos = $this->generateRandomId();
                $cekID = $this->userModel->findKosById($idKos);
            } while ($cekID);

            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => null,
                'password' => $password,
                'role' => $role,
                'id_kos' => $idKos
            ];

            if ($this->userModel->pemilik($data) > 0) {
                if ($this->userModel->createKos($data['id_kos'], $id) > 0 && $this->userModel->createKamar($data['id_kos']) > 0) {

                    $_SESSION['user'] = [
                        "id_user" => $data['id'],
                        "email" => $data['email'],
                        "role" => $data['role'],
                        "id_kos" => $data['id_kos']
                    ];

                    $this->view('login/verifpemilik', $data);
                    exit();
                } else {
                    echo json_encode($data['id_kos'], $id);
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


            if ($this->userModel->create($data) > 0) {
                $this->userModel->insert($id, 'aktif');
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],
                    "email" => $data['email'],
                    "role" => $data['role']
                ];

                $this->header('/');
                exit();
            } else {
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'role' => $role
                ];
                Flasher::setFlash('*Pastikan Semua Data Terisi Dengan Benar', 'danger');
                $this->view('login/setpassword', $data);
                exit();
            }
        }
    }

    public function out() {}

    private function generateRandomId()
    {

        $dateTime = date('Ym');


        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;
        return $generatedId;
    }

    public function verifPemilik() {}
}
