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
}
