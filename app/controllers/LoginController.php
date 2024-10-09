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
    public function setpassword()
    {
        $this->view('Login/setpassword');
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
            session_set_cookie_params(0);
            $_SESSION['user'] = $user;

            $this->header('/');
            exit();
        } else {
            // Flasher::setFlash('Akun Tidak di temukan', 'danger');
            // $this->header('/login');
            echo $user;
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

        session_destroy();

        // Redirect to home or login page
        $this->header('/');
        exit();
    }

    public function create()
    {
        $id = $this->generateRandomId();

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
            $_SESSION['user'] = $data['email'];

            $this->header('/');
            exit();
        }
    }

    public function Google()
    {

        $id = $this->generateRandomId();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['Password'];
        $confirm = $_POST['confirmPassword'];


        if (!($password == $confirm)) {
            Flasher::setFlash('Password Tidak Cocok', 'danger');
            $this->header('/setpassword');
            exit();
        }

        $data = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
        if ($this->userModel->createG($data) > 0) {
            session_set_cookie_params(0);

            $_SESSION['user'] = $data['email'];

            $this->header('/');
            exit();
        }
    }

    public function generateRandomId()
    {

        $dateTime = date('Ym'); // This gives you 12 characters (YYYYMMDDHHMM)

        
        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;

        echo $generatedId;
        return $generatedId;
    }
}
