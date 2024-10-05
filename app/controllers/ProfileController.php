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

    public function getData()
    {
        if (isset($_SESSION['user'])) {
            return json_decode($_SESSION['user']);
        }
        return null;
    }

    public function getRole()
    {
        $user = $this->getData();

        if ($user) {
            return $role = $user->role;
        }

        return null;
    }

    public function profile()
    {


        ob_start();
        $role = $this->getRole();

        if ($role == 'pencari kos') {
            $this->view('profile/profile');
            $content = ob_get_clean();

            $data = [
                "content" => $content,
                "title" => "profile",

            ];
        } else {
            $this->view('profile/profileKost');
            $content = ob_get_clean();

            $data = [
                "content" => $content,
                "title" => "Profile"
            ];
        }

        $this->view('layout/main', $data);
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

        $this->view('layout/main', $data);
    }
}
