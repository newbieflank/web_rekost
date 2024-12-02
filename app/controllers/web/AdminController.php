<?php

class AdminController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel =  $this->model('UsersModel');
    }
    public function getPersetujuanKos()
    {
        $data = $this->userModel->getPersetujuanKos();
        $this->view('admin/acceptance', ['data' => $data]);
    }
    public  function postPersetujuanKos()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $this->userModel->updateStatusPemilik($id, $status);
        $this->header('/acceptance');
    }

    public function getPemilikKos()
    {
        $data = $this->userModel->getPemilikKos();
        $this->view('admin/pemilikkos', ['data' => $data]);
    }
    public function getPencariKos()
    {
        $data = $this->userModel->getPencariKos();
        $this->view('admin/pencarikos', ['data' => $data]);
    }


    public function dashboard()
    {
        $totalPemilikKos = $this->userModel->countPemilikKos();
        $totalPencariKos = $this->userModel->countPencariKos();
        $totalKos = $this->userModel->countKos();
        $formatChartPemilik = [];
        $formatChartPencari = [];

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
            "chartPencari" => $formatChartPencari
        ]);
    }
    public function showUserRegistration()
    {
        $formatDate = [];
        for ($i = 0; $i < 30; $i++) {
            $userRegister = $this->userModel->getUserRegistrationByDate(date('Y-m-d', strtotime("-$i days")));
            $formatDate[] = $userRegister["total"];
        }
        $data = $this->userModel->getUserRegistration();
        $this->view('admin/dashboard', ['data' => $data]);
    }
}
