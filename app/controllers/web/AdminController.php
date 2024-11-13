<?php

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->view('admin/dashboard');
    }
    public function acceptance()
    {
        $this->view('admin/acceptance');
    }
    public function pencarikos()
    {
        $this->view('admin/pencarikos');
    }
    public function pemilikkos()
    {
        $this->view('admin/pemilikkos');
    }
}
