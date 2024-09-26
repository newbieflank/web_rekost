<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/landingpage');
    }
    public function popular()
    {
        $this->view('detail/popularkos');
    }
}
