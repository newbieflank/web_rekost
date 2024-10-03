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

    public function show($id)
    {
        // Use $id to fetch and display user information
        echo "User ID: " . htmlspecialchars($id);
    }

    public function auth()
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        if ($this->model('UsersModel')->loginAuth($username, $pass) > 0) {
        }
    }
}
