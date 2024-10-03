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

    public function show($id)
    {
        // Use $id to fetch and display user information
        echo "User ID: " . htmlspecialchars($id);
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
}
