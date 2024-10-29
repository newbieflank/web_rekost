<?php

class API extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = $this->model('UsersModel');
    }

    public function getProfile()
    {
        echo $this->user->getData();
    }
}
