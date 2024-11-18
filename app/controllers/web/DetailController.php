<?php

class DetailController extends Controller
{
    public function popularkos()
    {
        $popular = $this->model('CardViewModel')->SelectCardViewKosPoPular();
        $data = [
            "popular" => $popular
        ];
        $this->view('detail/popularkos',$data);
    }
    public function bestkos()
    {
        $best = $this->model('CardViewModel')->SelectCardViewKosBest();
        $data = [
            "best"=>$best
        ];
        $this->view('detail/bestkos',$data);
    }
    public function strategically()
    {
        $campus = $this->model('CardViewModel')->SelectCardViewKosCampus();
        $data = [
            "campus"=>$campus
        ];
        $this->view('detail/strategically',$data);
    }
    public function detailkos($id)
    {
        $DetailKos = $this->model('CardViewModel')->DetailKos($id);
        $DetailKos['fasilitas_kos'] = explode(',', $DetailKos['fasilitas_kos']);
        $DetailKos['fasilitas_kamar'] = explode(',', $DetailKos['fasilitas_kamar']);
        $DetailKos['peraturan_kos'] = explode(',', $DetailKos['peraturan_kos']);
        $this->view('detail/detailkos',$DetailKos);
    }
    public function chats()
    {
        $this->view('detail/chats');
    }
}
