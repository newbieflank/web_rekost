<?php

class API extends Controller
{
    public function users()
    {
        $data = [
            ["nama" => "kholit"],
            ["nama" => "Akbar"]
        ];

        echo json_encode($data);
    }
    public function user($id)
    {
        $data = [
            ["nama" => "kholit"],
            ["nama" => "Akbar"]
        ];

        echo json_encode($data);
    }
}
