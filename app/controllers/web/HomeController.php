<?php

class HomeController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UsersModel');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $role = $_SESSION['user']['role'];
            $idKos = $_SESSION['user']['id_kos'] ?? null;
            $user = $this->model('UsersModel')->findUserByEmail($email);

            if ($role === 'admin') {
                $totalPemilikKos = $this->userModel->countPemilikKos();
                $totalPencariKos = $this->userModel->countPencariKos();
                $totalKos = $this->userModel->countKos();
                $rating = $this->model('RatingAplikasiModel')->totalRating();
                $formatChartPemilik = [];
                $formatChartPencari = [];
                $totalRating = $rating['user'] > 0 ? $rating['rating'] / $rating['user'] : 0;
                $maxDays = date('t');
                for ($i = 1; $i <= $maxDays; $i++) {
                    $date = date("Y-m") . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                    $pemilikRegister = $this->userModel->getUserRegistrationByDate($date, 'pemilik kos');
                    $pencariRegister = $this->userModel->getUserRegistrationByDate($date, 'pencari kos');

                    $formatChartPemilik["date"][] = $i;
                    $formatChartPemilik["count"][] = $pemilikRegister["total"] ?? 0;

                    $formatChartPencari["date"][] = $i;
                    $formatChartPencari["count"][] = $pencariRegister["total"] ?? 0;
                }

                $this->view('admin/dashboard', [
                    'totalPemilikKos' => $totalPemilikKos,
                    'totalPencariKos' => $totalPencariKos,
                    'totalKos' => $totalKos,
                    "chartPemilik" => $formatChartPemilik,
                    "chartPencari" => $formatChartPencari,
                    'totalRatingKos' => $totalRating
                ]);
            } else if ($role === 'pemilik kos') {
                $notifModel = $this->model('Notifmodel');
                $notifikasiPemilik = $notifModel->getNotifikasiPemilik($_SESSION['user']['id_user']);

                $pendapatan = $this->model('chartModel')->getpendapatan();
                $pengeluaran = $this->model('chartModel')->getpengeluaran();
                $rataRating = $this->model('chartModel')->getUlasan();
                $ratingatas = $this->model('chartModel')->getulasanatas();
                $chartpendapatan = $this->model('chartModel')->gettransaksi($idKos);
                $chartpengeluaran = $this->model('chartModel')->gettransaksi2();
                $penyewa = $this->model('KosModel')->jumlahPenyewa();
                $ulasan = $this->model('KosModel')->totalRating();

                $ulasan['user'] > 0 ? $jumlah = $ulasan['rating'] / $ulasan['user'] : $jumlah = 0;

                $pendapatanPerBulan = array_fill(0, 12, 0);
                foreach ($chartpendapatan as $item) {
                    $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
                    $pendapatanPerBulan[$bulanIndex] = (int) $item['total_transaksi'];
                }

                $pengeluaranPerBulan = array_fill(0, 12, 0);
                foreach ($chartpengeluaran as $item) {
                    $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
                    $pengeluaranPerBulan[$bulanIndex] = (int) $item['total_transaksi'];
                }

                $layoutData = [
                    "pendapatan" => $pendapatan,
                    "pengeluaran" => $pengeluaran,
                    "rataRating" => $rataRating,
                    "ratingatas" => $ratingatas,
                    "chartpendapatan" => $pendapatanPerBulan,
                    "chartpengeluaran" => $pengeluaranPerBulan,
                    "penyewa" => $penyewa,
                    "ulasan" => $jumlah,
                ];

                ob_start();
                $this->view('home/landingpemilik', $layoutData);
                $content = ob_get_clean();

                $data = [
                    'content' => $content,
                    "id_user" => $user['id_user'],
                    "id_gambar" => $user['id_gambar'],
                    "role" => $user['role'],
                    "title" => 'Home',
                    "notifikasiPemilik" => $notifikasiPemilik

                
                ];

                $this->view('layout/main', $data);

            } else {
                $notifModel = $this->model('Notifmodel');
                $notifikasi = $notifModel->getNotifikasi($_SESSION['user']['id_user']);

                $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular(true);
                $best = $this->model('CardViewModel')->SelectCardViewKosBest(true);
                $campus = $this->model('CardViewModel')->SelectCardViewKosCampus(true);
                $rating = $this->model('RatingAplikasiModel')->GetUlasan();
                $penyewa = $this->model('RatingAplikasiModel')->GetTotalPenyewa();

                if (!empty($user['Instansi'])) {
                    $institutionName = $user['Instansi'];
                    $coordinates = $this->getCoordinates($institutionName);
                    $Kosterdekat = $this->model('CardViewModel')->SelectNearestKos(true, $coordinates['lat'], $coordinates['lng'], 5);
                } else {
                    $Kosterdekat = $campus;
                }

                if (empty($Kosterdekat)) {
                    $Kosterdekat = $campus;
                }

                $data = [
                    "id_user" => $user['id_user'],
                    "id_gambar" => $user['id_gambar'],
                    "popular" => $popular,
                    "best" => $best,
                    "campus" => $Kosterdekat,
                    "rating_aplikasi" => $rating,
                    "penyewa" => $penyewa,
                    "notifikasi" => $notifikasi,
                ];
                $this->view('home/landingpage', $data);
            }

        } else {
            $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular(true);
            $best = $this->model('CardViewModel')->SelectCardViewKosBest(true);
            $campus = $this->model('CardViewModel')->SelectCardViewKosCampus(true);
            $rating = $this->model('RatingAplikasiModel')->GetUlasan();
            $penyewa = $this->model('RatingAplikasiModel')->GetTotalPenyewa();
            $data = [
                "popular" => $popular,
                "best" => $best,
                "campus" => $campus,
                "rating_aplikasi" => $rating,
                "penyewa" => $penyewa
            ];
            $this->view('home/landingpage', $data);
        }
    }
    public function search()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->model('UsersModel')->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        $alamat = isset($_POST['location']) ? $_POST['location'] : '';
        $harga = isset($_POST['cost']) ? $_POST['cost'] : null;

        $search = $this->model('KosModel')->CariKos($alamat, $harga);
        $data = [
            'search' => $search,
            'alamat' => $alamat,
            'harga' => $harga
        ];

        ob_start();
        $this->view('home/search', $data);
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

    public function cari()
    {
        $alamat = $_GET['lokasi'] ?? null;
        $harga = $_GET['harga'] ?? null;
        $urutan = $_GET['urutan'] ?? null;

        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $user = $this->model('UsersModel')->findUserByEmail($email);
            $role = $user['role'];
        } else {
            $role = "pencari_kos";
        }

        $search = $this->model('KosModel')->CariKosByFilter($alamat, $harga, $urutan);
        $data = [
            'search' => $search
        ];

        ob_start();
        $this->view('home/search', $data);
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


    public function best()
    {
        $this->view('detail/bestkos');
    }
    public function home()
    {
        $pendapatan = $this->model('chartModel')->getpendapatan();
        $pengeluaran = $this->model('chartModel')->getpengeluaran();
        $rataRating = $this->model('chartModel')->getUlasan();
        $ratingatas = $this->model('chartModel')->getulasanatas();
        $chartpendapatan = $this->model('chartModel')->gettransaksi();
        $chartpengeluaran = $this->model('chartModel')->gettransaksi2();

        $pendapatanPerBulan = array_fill(0, 12, 0);
        foreach ($chartpendapatan as $item) {
            $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
            $pendapatanPerBulan[$bulanIndex] = (int) $item['total_transaksi'];
        }

        $pengeluaranPerBulan = array_fill(0, 12, 0);
        foreach ($chartpengeluaran as $item) {
            $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
            $pengeluaranPerBulan[$bulanIndex] = (int) $item['total_transaksi'];
        }


        $data = [
            "pendapatan" => $pendapatan,
            "pengeluaran" => $pengeluaran,
            "rataRating" => $rataRating,
            "ratingatas" => $ratingatas,
            "chartpendapatan" => $pendapatanPerBulan,
            "chartpengeluaran" => $pengeluaranPerBulan


        ];
        $this->view('home/landingpemilik', $data);
    }




    public function verif()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->view('login/verifpemilik');
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
        echo json_encode($_SESSION['new']);
    }

    public function AddUlasan()
    {
        if (!isset($_SESSION['user'])) {
            $this->header('/login');
            exit;
        }

        $ulasan = $_POST['reviewInput'];
        $rating = $_POST['rating'];
        $id = $_SESSION['user']['id_user'];
        $data = [
            "ulasan" => $ulasan,
            "id_user" => $id,
            "rating" => $rating
        ];
        if ($this->model("RatingAplikasiModel")->AddRating($data) > 0) {
            $this->header('/');
            exit;
        } else {
            echo json_encode($data);
        }
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
