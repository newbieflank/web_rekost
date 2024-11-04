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
            if (isset($_POST['remember'])) {
                setcookie("user", $user, time() + (86400 * 30), "/", "", true);
                $this->header('/');
                exit();
            }
            if ($user['role'] === 'pemilik kos') {
                $data = $this->userModel->findOwnerById($user['id_user']);

                $_SESSION['user'] = [
                    "id_user" => $user['id_user'],
                    "email" => $user['email'],
                    "role" => $user['role'],
                    "id_kos" => $data['id_kos']
                ];
            } else {
                $_SESSION['user'] = [
                    "id_user" => $user['id_user'],
                    "email" => $user['email'],
                    "role" => $user['role']
                ];
            }

            $this->header('/');
            exit();
        } else {
            Flasher::setFlash('*Akun Tidak di Temukan', 'danger');
            $this->header('/login');
            exit();
        }
    }
    public function logout()
    {
        // Ensure session is started before manipulating it
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all session variables
        $_SESSION = array();
        session_unset();
        session_destroy();

        // Redirect to home or login page
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


        $data = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'number' => $number,
            'password' => $password
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
                'number' => '',
                'password' => $password,
                'role' => $role,
                'id_kos' => $kosID
            ];

            if ($this->userModel->pemilik($data) > 0) {
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
            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'number' => '',
                'password' => $password,
                'role' => $role
            ];

            if ($this->userModel->createG($data) > 0) {
                session_set_cookie_params(0);
                $_SESSION['user'] = [
                    "id_user" => $data['id'],  // Fixed undefined variable
                    "email" => $data['email'],
                    "role" => $data['role']
                ];

                $this->header('/');
                exit();
            } else {
                echo json_encode($data);
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
