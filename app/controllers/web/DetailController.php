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
        $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
        $data = [
            "popular" => $popular
        ];
        $this->view('detail/popularkos', $data);
    }
    public function bestkos()
    {
        $best = $this->model('CardViewModel')->SelectCardViewKosBest();
        $data = [
            "best" => $best
        ];
        $this->view('detail/bestkos', $data);
    }
    public function strategically()
    {
        $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
        $data = [
            "campus" => $campus
        ];
        $this->view('detail/strategically', $data);
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
