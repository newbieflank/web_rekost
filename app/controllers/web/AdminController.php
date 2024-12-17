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

        foreach ($data as &$item) {
            if (isset($item['last_online'])) {
                $data = array_merge($data, []);
                $item['online'] = $this->formatDateHumanReadable($item['last_online']);
            } else {
                $item['online'] = 'Never';
            }
        }

        $this->view('admin/pemilikkos', ['data' => $data]);
    }
    public function getPencariKos()
    {
        $data = $this->userModel->getPencariKos();

        foreach ($data as &$item) {
            if (isset($item['last_online'])) {
                $data = array_merge($data, []);
                $item['online'] = $this->formatDateHumanReadable($item['last_online']);
            } else {
                $item['online'] = 'Never';
            }
        }

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

    private function formatDateHumanReadable($dateTime)
    {
        $date = new DateTime($dateTime);
        $now = new DateTime();
        $today = new DateTime('today');

        $diff = $now->diff($date);

        if ($date >= $today) {
            return 'Hari ini';
        } elseif ($diff->days == 1) {
            return 'Kemarin';
        } elseif ($diff->days < 7) {
            return $diff->days . ' Hari yang lalu';
        } elseif ($diff->days < 30) {
            return ceil($diff->days / 7) . ' Minggu' . (ceil($diff->days / 7) > 1 ? 's' : '') . ' yang lalu';
        } elseif ($diff->days < 365) {
            return $date->format('F') . ' ' . $date->format('j');
        } else {
            return $date->format('Y-m-d');
        }
    }
}
