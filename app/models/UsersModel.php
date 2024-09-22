<?php

class UsersModel
{
    private $table = 'users';
    private $db;



    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProfile($id)
    {
        $query = "SELECT * FROM" . $this->table . " WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->single();
    }
}
