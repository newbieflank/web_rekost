<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/landingpage');
    }
    public function popularkos()
    {
        $this->view('detail/popularkos');
    }
<<<<<<< HEAD
=======


    public function best()
    {
        $this->view('detail/bestkos');
    }



>>>>>>> 25d197d (komit kedua)
    public function bestkos()
    {
        $this->view('detail/bestkos');
    }
    public function strategically()
    {
        $this->view('detail/strategically');
    }
<<<<<<< HEAD
=======

>>>>>>> 25d197d (komit kedua)
}
