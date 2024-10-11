<?php

class ProfileController extends Controller
{
    private $baseURL = "";

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }
    }

    public function getRole()
    {
        $user = $_SESSION['user'];

        if ($user) {
            return $role = $user['role'];
        }

        return null;
    }

    public function profile()
    {
        $user = $_SESSION['user'];

        ob_start();
        $role = $this->getRole();

        if ($role == 'pencari kos') {
            $userData = [
                "username" => $user['nama']
            ];
            $this->renderProfile('profile/profile', 'Profile', $userData);
        } else {
            $this->renderProfile('profile/profileKost', 'Profile');
        }
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

    private function renderProfile($viewPath, $pageTitle, $data = [])
    {
        ob_start();
        $this->view($viewPath, $data);
        $content = ob_get_clean();

        $layoutData = [
            "content" => $content,
            "title" => $pageTitle
        ];

        $this->view('layout/main', $layoutData);
    }
}
