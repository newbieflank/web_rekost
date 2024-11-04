<?php

class HomeController extends Controller
{


    public function index()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->model('UsersModel')->findUserByEmail($email);

            $layoutData = [
                "id_user" => $user['id_user'],
                "id_gambar" => $user['id_gambar']
            ];
            $this->view('home/landingpage', $layoutData);
        }
        $this->view('home/landingpage');
    }
    public function popularkos()
    {
        $this->view('detail/popularkos');
    }

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
