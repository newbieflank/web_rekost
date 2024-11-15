<?php
require_once './app/core/Database.php';

class UsersModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findKost($id)
    {
        $query = "SELECT nama_kos FROM detail_kos WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id);

        return $this->db->single();
    }

    public function findUserById($id)
    {
        $query = "SELECT * FROM user WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id);

        return $this->db->single();
    }

    public function findKosById($id)
    {
        $query = "SELECT * FROM kos WHERE id_kos = :id_kos";
        $this->db->query($query);
        $this->db->bind('id_kos', $id);

        return $this->db->single();
    }

    public function findOwnerById($id)
    {
        $query = "SELECT * FROM pemilik WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id);

        return $this->db->single();
    }

    public function getProfile($email, $password = null)
    {
        if ($password) {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND password = :password";
            $this->db->query($query);
            $this->db->bind('password', $password);
        } else {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
            $this->db->query($query);
        }
        $this->db->bind('email', $email);
    
        return $this->db->single();
    }
    
    public function findUserByEmail($email)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $this->db->query($query);
        $this->db->bind('email', $email);

        return $this->db->single();
    }

    public function registerUser($data)
    {
        $_SESSION['register'] = $data;
        exit();
    }

    public function create($data)
    {
        $query = "INSERT INTO user (id_user, nama, email, password, number_phone, role) 
                  VALUES (:id, :nama, :email, :pass, :nomor, :role)";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', $data['password']);
        $this->db->bind('nomor', $data['number']);
        $this->db->bind('role', $data['role']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function pemilik($data)
    {
        $query1 = "INSERT INTO user (id_user, nama, email, password, number_phone, role) 
                   VALUES (:id, :nama, :email, :pass, :nomor, :role)";
        $this->db->query($query1);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', $data['password']);
        $this->db->bind('nomor', $data['number']);
        $this->db->bind('role', $data['role']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function createKos($id_kos, $id)
    {
        try {
            $query2 = "INSERT INTO kos (id_kos, id_user) VALUES (:id_kos, :id_user)";
            $this->db->query($query2);
            $this->db->bind('id_kos', $id_kos);
            $this->db->bind('id_user', $id);

            $this->db->execute();

            return $this->db->rowCount();
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function updateProfile($data)
    {
        $id = $_SESSION['user']['id_user'] ?? null;
        if (!$id) {
            echo "User ID not found in session.";
            return;
        }

        $query = 'UPDATE user SET nama = :nama, jenis_kelamin = :gender, tanggal_lahir = :tanggal, Instansi = :instansi, pekerjaan = :pekerjaan, kota_asal = :kota, number_phone = :telp, status = :status, alamat = :alamat WHERE id_user = :id';
        $this->db->query($query);
        $this->db->bind('nama', $data['name'] ?? null);
        $this->db->bind('gender', $data['inputGender'] ?? null);
        $this->db->bind('tanggal', isset($data['customDate']) ? $this->formatDate($data['customDate']) : null);
        $this->db->bind('pekerjaan', $data['pekerjaan'] ?? null);
        $this->db->bind('instansi', $data['inputInstansi'] ?? null);
        $this->db->bind('kota', $data['kotaAsal'] ?? null);
        $this->db->bind('telp', $data['noTelp'] ?? null);
        $this->db->bind('status', $data['status'] ?? null);
        $this->db->bind('alamat', $data['alamat'] ?? null);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function insert($id)
    {
        $query = "INSERT INTO status_user (id_user) VALUES (:id_user)";
        $this->db->query($query);
        $this->db->bind('id_user', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // Update the user's online status
    public function updateUserStatus($userId, $status)
    {
        var_dump($userId, $status);  // Tambahkan pengecekan untuk melihat nilai yang dikirim
        $query = "UPDATE user SET status_user = :status WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $userId);
        $this->db->bind('status', $status);
    
        $this->db->execute();
        return $this->db->rowCount();
    }
    

    public function getOnlineUsers()
    {
        $query = "SELECT * FROM user WHERE status_user = 'online'";
        $this->db->query($query);

        return $this->db->resultSet();
    }

    private function formatDate($date)
    {
        $tanggal = DateTime::createFromFormat('d-F-Y', $date);
        return $tanggal ? $tanggal->format('Y-m-d') : null;
    }
}
