<?php


class UsersModel
{
    private $table = 'users';
    private $db;

    // public function __construct()
    // {
    //     $this->db = new Database();
    // }

    public function getProfile($id)
    {
        $query = "SELECT * FROM" . $this->table . " WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->single();
    }

    public function loginAuth($username, $pass)
    {
        // $query = "SELECT * FROM" . $this->table . " Where username=:username and password=:password";
        // $this->db->query($query);
        // $this->db->bind('username', $username);
        // $this->db->bind('password', $pass);
        // $this->db->single();

        // return $this->db->rowCount();

        if ($username == "mafira" && $pass == 123) {
            return 1;
        }
    }
}
