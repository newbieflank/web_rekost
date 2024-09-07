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
}
