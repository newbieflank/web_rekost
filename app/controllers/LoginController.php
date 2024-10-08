<?php

class LoginController extends Controller
{

    private $userModel;
    private $userData;




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

    public function auth($data = null)
    {
        $email = $_POST['username'];
        $password = $_POST['password'];

        $user = json_encode($this->model('UsersModel')->getProfile($email, $password));
        if (isset($_POST['remember'])) {
            setcookie("user", $user, time() + (86400 * 30), "/", "", true);
            $this->header('/');
            exit();
        }
        if (isset($this->user->id)) {
            session_set_cookie_params(0);
            $_SESSION['user'] = $user;

            $this->header('/');
            exit();
        } else {
            Flasher::setFlash('Akun Tidak Di Temukan', 'danger');
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
        $username = $_POST['fullname'];
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

            echo json_encode($data);
            $_SESSION['user'] = $data['email'];

            $this->header('/');
            exit();
        }
    }

    public function generateRandomId()
    {

        $dateTime = date('YmdHis');

        $generatedId = $dateTime;

        return $generatedId;
    }
}
