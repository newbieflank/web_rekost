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

        return $this->db->single(); // Return user data, including the hashed password
    }


    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email= :email";
        $this->db->query($query);
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function registerUser($data)
    {
        $_SESSION['register'] = $data;

        $this->view('login/setpassword');
        exit();
    }

    public function create($data)
    {

        $query = "INSERT INTO user (id_user, nama, email, password, number_phone) VALUES (:id, :nama, :email, :pass, :nomor)";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', $data['password']);
        $this->db->bind('nomor', $data['number']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function createG($data)
    {
        $query = "INSERT INTO user (id_user, nama, email, password) VALUES (:id, :nama, :email, :pass)";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', $data['password']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
