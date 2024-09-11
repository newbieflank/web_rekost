<?php

class HomeController extends Controller
{
    public function index()
    {
        ob_start();
        $this->view('home/index');
        $content = ob_get_clean();
        $data['content'] = $content;
        $data['title'] = 'Home';

        $this->view('layout/main', $data);
    }
}
