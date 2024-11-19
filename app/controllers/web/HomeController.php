<?php

class HomeController extends Controller
{


    public function index()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
            $role = $_SESSION['user']['role'];
            $user = $this->model('UsersModel')->findUserByEmail($email);

            $layoutData = [
                "id_user" => $user['id_user'],
                "id_gambar" => $user['id_gambar'],
                "title" => 'Home'
            ];
            if ($role === 'pemilik kos') {
                $this->view('home/landingpemilik', $layoutData);
            } else {
                $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
                $best = $this->model('CardViewModel')->SelectCardViewKosBest();
                $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
                $rating = $this->model('RatingAplikasiModel')->GetUlasan();
                $penyewa = $this->model('RatingAplikasiModel')->GetTotalPenyewa();
                $data = [
                    "id_user" => $user['id_user'],
                    "id_gambar" => $user['id_gambar'],
                    "popular" => $popular,
                    "best" => $best,
                    "campus" => $campus,
                    "rating_aplikasi" => $rating,
                    "penyewa" => $penyewa
                ];
                $this->view('home/landingpage', $data);
            }
        } else {
            $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
            $best = $this->model('CardViewModel')->SelectCardViewKosBest();
            $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
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
    public function popularkos()
    {
        $this->view('detail/popularkos');
    }
    public function search()
    {
        
        $this->view('home/search');
    }

    public function best()
    {
        $this->view('detail/bestkos');
    }
    public function home()
    {
        $pendapatan = $this->model('chartModel')->getpendapatan();
        $pengeluaran = $this->model ('chartModel')->getpengeluaran();
        $rataRating = $this->model('chartModel')->getUlasan();
        $ratingatas = $this->model('chartModel')->getulasanatas();
        $chartpendapatan = $this->model('chartModel')->gettransaksi();
        $chartpengeluaran = $this->model('chartModel')->gettransaksi2();
    
        $pendapatanPerBulan = array_fill(0, 12, 0);
        foreach ($chartpendapatan as $item) {
            $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
            $pendapatanPerBulan[$bulanIndex] = (int)$item['total_transaksi'];
        }

        $pengeluaranPerBulan = array_fill(0, 12, 0);
        foreach ($chartpengeluaran as $item) {
            $bulanIndex = $item['bulan_index'] - 1; // Bulan_index (1 = January) menjadi array index (0 = January)
            $pengeluaranPerBulan[$bulanIndex] = (int)$item['total_transaksi'];
        }
        

        $data = [
            "pendapatan" => $pendapatan
            ,"pengeluaran"=> $pengeluaran
            ,"rataRating"=>$rataRating
            ,"ratingatas"=>$ratingatas,
            "chartpendapatan" => $pendapatanPerBulan,
            "chartpengeluaran" => $pengeluaranPerBulan

            
        ];   
        $this->view('home/landingpemilik', $data);
    }

    

    
    public function verif()
    {
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
}
