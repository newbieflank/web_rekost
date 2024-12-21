<?php

require_once __DIR__ . '/../api/Pengingat.php';
class TestPush extends Controller
{
    private $KirimPengingat;

    public function __construct()
    {
        $this->KirimPengingat = new Pengingat();
    }

    public function CekdanPush()
    {
        $this->KirimPengingat->CekdanPush();

        echo 'Cuma buat test aja ';
    }
}