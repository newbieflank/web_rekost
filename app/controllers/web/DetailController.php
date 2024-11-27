<?php

class DetailController extends Controller
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UsersModel');
    }
    public function popularkos()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
        $data = [
            "popular" => $popular
        ];
        ob_start();
        $this->view('detail/popularkos', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "Re-Kos",
            "role" => $user['role'],
            'id_user' => $user['id_user'],
            'id_gambar' => $user['id_gambar']
        ];

        $this->view('layout/main', $layout);
    }
    public function bestkos()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $best = $this->model('CardViewModel')->SelectCardViewKosBest();
        $data = [
            "best" => $best
        ];

        ob_start();
        $this->view('detail/bestkos', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "Re-Kos",
            "role" => $user['role'],
            'id_user' => $user['id_user'],
            'id_gambar' => $user['id_gambar']
        ];

        $this->view('layout/main', $layout);
    }
    public function strategically()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);
        $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
        $data = [
            "campus" => $campus
        ];

        ob_start();
        $this->view('detail/strategically', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "Re-Kos",
            "role" => $user['role'],
            'id_user' => $user['id_user'],
            'id_gambar' => $user['id_gambar']
        ];

        $this->view('layout/main', $layout);
    }
    public function detailkos($id)
    {
        $email = $_SESSION['user']['email'];
        $user = $this->userModel->findUserByEmail($email);

        $DetailKos = $this->model('CardViewModel')->DetailKos($id);
        $DetailKos['fasilitas_kos'] = explode(',', $DetailKos['fasilitas_kos']);
        $DetailKos['jenis_fasilitas'] = explode(',', $DetailKos['jenis_fasilitas']);
        $DetailKos['peraturan_kos'] = explode(',', $DetailKos['peraturan_kos']);

        ob_start();
        $this->view('detail/detailkos', $DetailKos);
        $content = ob_get_clean();

        $data = [
            'content' => $content,
            'title' => "detail",
            "role" => $user['role'],
            'id_user' => $user['id_user'],
            'id_gambar' => $user['id_gambar']
        ];

        $this->view('layout/main', $data);
    }
    public function chats()
    {
        $this->view('detail/chats');
    }
}
