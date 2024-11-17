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
                    "popular" => $popular,"best"=>$best,"campus"=>$campus, "rating_aplikasi" => $rating,
                    "id_gambar" => $user['id_gambar'],"penyewa"=>$penyewa
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
                "best"=>$best,
                "campus"=>$campus, 
                "rating_aplikasi" => $rating,
                "penyewa" => $penyewa
            ];
            $this->view('home/landingpage',$data);
        }
    }
    public function popularkos()
    {
        $this->view('detail/popularkos');
    }

    public function best()
    {
        $this->view('detail/bestkos');
    }
    public function home()
    {
        $pendapatan = $this->model('chartModel')->getpendapatan();
        $pengeluaran = $this->model ('chartModel')->getpengeluaran();
        $ulasan=$this->model('chartmodel')->getUlasan();

        $data = [
            "pendapatan" => $pendapatan
            ,"pengeluaran"=> $pengeluaran
            ,"ulasan"=>$ulasan
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

    public function AddUlasan(){
        if(!isset($_SESSION['user'])){
            $this->header('/login');
            exit;
        }

        $ulasan = $_POST['reviewInput'];
        $id = $_SESSION['user']['id_user'];
        $data = [
            "ulasan" => $ulasan,
            "id_user" => $id
        ];
        if ($this->model("RatingAplikasiModel")->AddRating($data) > 0) {
            $this->header('/');
            exit;
        } else {
            echo json_encode($data);
        }
    }
}
