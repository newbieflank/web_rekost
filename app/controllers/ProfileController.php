<?php

class ProfileController extends Controller
{
    private $baseURL = "";

    public function __construct()
    {
        // if (!isset($_SESSION['user'])) {
        //     header('Location: login');
        //     exit;
        // }
    }

    public function profile()
    {
        ob_start();
        $this->view('profile/profile');
        $content = ob_get_clean();

        // $data['user'] = $this->model('UsersModel')->getProfile($id);

        $data = [
            "content" => $content,
            "title" => "profile",

        ];

        $this->view('layout/main2', $data);
    }

    public function profileKost()
    {
        ob_start();
        $this->view('profile/profileKost');
        $content = ob_get_clean();

        $data = [
            "content" => $content,
            "title" => "Profile"
        ];
    }
}
