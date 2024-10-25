<?php

class DetailController extends Controller
{
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
    public function detailkos()
    {
        $this->view('detail/detailkos');
    }
}
