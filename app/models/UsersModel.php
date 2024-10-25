<?php


class UsersModel extends Controller
{
    private $table = 'user';
    private $db;
    public $username;
    public $email;
    public $id;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProfile($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email=:email AND password=:password";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->bind('password', $password);
        $this->db->single();
    }


    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email=:email";
        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->single();
    }

    public function registerUser($data)
    {
        $username = $data['name'];
        $email = $data['email'];

        $this->header('/confirm');
        exit();
    }
}
