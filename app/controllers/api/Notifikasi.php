<?php

class Notifikasi extends Controller
{
    public function getNotifikasi($id_user)
    {
        $notifModel = $this->model('NotifModel'); 
        $notifikasi = $notifModel->getNotifikasi($id_user);


        header('Content-Type: application/json');

        if ($notifikasi) {
            echo json_encode($notifikasi);
        } else {
            echo json_encode([]);
        }
    }
}
