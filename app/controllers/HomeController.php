<?php

class HomeController extends Controller
{
    private $userModel;
    public function __construct()
    {
        // $this->userModel = $this->model('UsersModel');
        // if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
        //     $this->getImg();
        // }
    }


    public function index()
    {
        $this->view('home/landingpage');
    }
    public function popularkos()
    {
        $this->view('detail/popularkos');
    }

    // public function getImg()
    // {
    //     if ($_SESSION['user']) {
    //         $id = $_SESSION['user']->id;
    //     } else if ($_COOKIE['user']) {
    //         $id = $_COOKIE['user']->id;
    //     }
    //     $this->userModel->imgProfile($id);
    // }

    public function best()
    {
        $this->view('detail/bestkos');
    }



    public function bestkos()
    {
        $this->view('detail/bestkos');
    }
    public function strategically()
    {
        $this->view('detail/strategically');
    }

    public function echo()
    {
        echo json_encode($_SESSION['user']);
    }
}
