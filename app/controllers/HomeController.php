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
    public function bestkos()
    {
        $this->view('detail/bestkos');
    }
    public function strategically()
    {
        $this->view('detail/strategically');
    }
}
