<?php

class LoginController extends Controller
{

    public $userModel;

    public function __construct()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->userModel = $this->model('UsersModel');
    }

    public function login()
    {
        if (isset($_SESSION['already_log']) == true) {
            $this->header('/');
            exit;
        }

        $this->view('login/login');
    }


    public function register()
    {
        if (isset($_SESSION['already_log']) == true) {
            $this->header('/');
            exit;
        }

        $this->view('login/register');
    }

    public function auth()
    {

        $email = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->getProfile($email, $password);
        if (isset($user['id_user'])) {
            $this->userModel->login($user['id_user']);
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
                $_SESSION['already_log'] = true;
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
                $_SESSION['already_log'] = true;
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

        // Nonaktifkan cache browser
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");

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

                    $_SESSION['already_log'] = true;
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
                $_SESSION['already_log'] = true;
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
                $_SESSION['new'] = true;
                $this->header('/profile');
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

    public function forget()
    {
        $this->view('login/forgotPassword');
    }

    public function requestReset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);

            $user = $this->userModel->findUserByEmail($email);
            if (!$user) {
                Flasher::setFlash('*Akun Tidak di Temukan', 'danger');
                $this->view('login/setpassword', ['email' => $email]);
                exit();
            }

            $token = bin2hex(random_bytes(32));
            $this->userModel->storeResetToken($user['id_user'], $token);

            $resetLink = BASEURL . "forgetPassword/reset?token=" . $token;
            sendResetEmail($email,  $resetLink);

            $this->view('login/forgotPassword', ['email' => $email]);
            exit();
        } else {
            $this->header('/forgetPassword');
        }
    }

    public function reset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
            $token = $_GET['token'];
            $user = $this->userModel->findUserByToken($token);
            if (!$user) {
                Flasher::setFlash('*Token tidak valid atau telah kedaluwarsa.', 'danger');
                $this->header('/forgetPassword');
                exit;
            }
            $this->view('login/resetPassword');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['password'];
            $konfirmasiPassword = $_POST['konfirmasi'];

            $data = [
                'token' => $token
            ];

            if (empty($newPassword) || empty($konfirmasiPassword) || empty($token)) {
                Flasher::setFlash('*Semua field harus diisi.', 'danger');
                $this->view('login/resetPassword');
                exit;
            }

            $user = $this->userModel->findUserByToken($token);
            if (!$user) {
                Flasher::setFlash('*Token tidak valid atau telah kedaluwarsa.', 'danger');
                $this->header('/forgetPassword');
                exit;
            }

            if ($newPassword !== $konfirmasiPassword) {
                Flasher::setFlash('*Pastikan kedua password sama.', 'danger');
                $this->view('login/resetPassword', $data);
                exit;
            }

            if (strlen($newPassword) < 8) {
                Flasher::setFlash('*Password harus memiliki minimal 8 karakter.', 'danger');
                $this->view('login/resetPassword', $data);
                exit;
            }

            // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            if ($this->userModel->updatePassword($user['id_user'], $newPassword) > 0) {
                $this->userModel->deleteToken($user['id_user']);
                Flasher::setFlash('*Password berhasil diubah. Silakan login.', 'success');
                $this->header('/login');
                exit;
            } else {
                Flasher::setFlash('*Gagal mengubah password.', 'danger');
                $this->view('login/resetPassword', $data);
                exit;
            }
        }
    }


    private function generateRandomId()
    {

        $dateTime = date('Ym');


        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;
        return $generatedId;
    }

    public function verifPemilik() {}
    public function forgotPassword()
    {
        $this->view('login/forgotPassword');
    }
    public function resetPassword()
    {
        $this->view('login/resetPassword');
    }
}
