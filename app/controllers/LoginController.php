<?php

class LoginController extends Controller
{

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
        }
        if (isset($user)) {
            session_set_cookie_params(0);
            $_SESSION['user'] = $user;

            $this->header('/');
            exit();
        } else {
            die('Login Failed');
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

    public function create($data) {}
}
