<?php

class UsersModel
{
    private $table = 'table';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
