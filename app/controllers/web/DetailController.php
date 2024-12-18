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
        $lokasi = $_GET['lokasi'] ?? null;
        $harga = $_GET['harga'] ?? null;

        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->userModel->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        if (!empty($lokasi) || !empty($harga)) {
            $popular = $this->model('CardViewModel')->SelectCardViewKosPopularByFilter($lokasi, $harga);
        } else {
            $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
        }

        $data = [
            "popular" => $popular
        ];
        ob_start();
        $this->view('detail/popularkos', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "cari kos",
            'role' => $role,
            'footer' => false
        ];

        if (isset($user)) {
            $layout = array_merge($layout, [
                'id_user' => $user['id_user'],
                'id_gambar' => $user['id_gambar']
            ]);
        }

        $this->view('layout/main', $layout);
    }
    public function bestkos()
    {
        $lokasi = $_GET['lokasi'] ?? null;
        $harga = $_GET['harga'] ?? null;
        $urutan = $_GET['urutan'] ?? null;

        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->userModel->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        if (!empty($lokasi) || !empty($harga) || !empty($urutan)) {
            $best = $this->model('CardViewModel')->SelectCardViewKosBestByFilter($lokasi, $harga, $urutan);
        } else {
            $best = $this->model('CardViewModel')->SelectCardViewKosBest();
        }

        $data = [
            "best" => $best
        ];

        ob_start();
        $this->view('detail/bestkos', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "cari kos",
            'role' => $role,
            'footer' => false
        ];

        if (isset($user)) {
            $layout = array_merge($layout, [
                'id_user' => $user['id_user'],
                'id_gambar' => $user['id_gambar']
            ]);
        }

        $this->view('layout/main', $layout);
    }
    public function strategically()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->userModel->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
        $data = [
            "campus" => $campus
        ];

        ob_start();
        $this->view('detail/strategically', $data);
        $content = ob_get_clean();

        $layout = [
            'content' => $content,
            'title' => "cari kos",
            'role' => $role,
            'footer' => false
        ];

        if (isset($user)) {
            $layout = array_merge($layout, [
                'id_user' => $user['id_user'],
                'id_gambar' => $user['id_gambar']
            ]);
        }

        $this->view('layout/main', $layout);
    }
    public function detailkos($id)
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }
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
