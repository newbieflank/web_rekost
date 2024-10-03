<?php


class UsersModel extends Controller
{
    private $table = 'users';
    private $db;
    public $username;
    public $email;
    public $id;

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

    public function login($username, $pass)
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
        $id = $data['google_id'];

        $this->header('/confirm');
    }
}
