<?php

class ProfileController extends Controller
{

    private $id = '123';
    private $name = 'mafira';
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

        $this->view('layout/main', $data);
    }
}
