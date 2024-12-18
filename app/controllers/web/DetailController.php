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
        $urutan = $_GET['urutkan'] ?? null;

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
        $lokasi = $_GET['lokasi'] ?? null;
        $harga = $_GET['harga'] ?? null;
        $urutan = $_GET['urutkan'] ?? null;

        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->userModel->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
        if (!empty($user['Instansi'])) {
            $institutionName = $user['Instansi'];
            $coordinates = $this->getCoordinates($institutionName);
            if (!empty($lokasi) || !empty($harga) || !empty($urutan)) {
                $Kosterdekat = $this->model('CardViewModel')->SelectNearestKosByFilter($coordinates['lat'], $coordinates['lng'], 5, $lokasi, $harga, $urutan);
            } else {
                $Kosterdekat = $this->model('CardViewModel')->SelectNearestKos($coordinates['lat'], $coordinates['lng'], 5);
            }
        } else {
            if (!empty($lokasi) || !empty($harga) || !empty($urutan)) {
                $Kosterdekat = $this->model('CardViewModel')->SelectCardViewKosCampusByFilter($lokasi, $harga, $urutan);
            } else {
                $Kosterdekat = $campus;
            }
        }

        $data = [
            "campus" => $Kosterdekat
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


    public function getCoordinates($locationName)
    {
        $url = "https://photon.komoot.io/api/?q=" . urlencode($locationName);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['features'][0])) {
            return [
                'lat' => $data['features'][0]['geometry']['coordinates'][1], // Latitude
                'lng' => $data['features'][0]['geometry']['coordinates'][0], // Longitude
            ];
        } else {
            return null;
        }
    }
}
