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

    public function findKamarById($id)
    {
        $query = "SELECT * FROM kamar WHERE id_kamar = :id_kos";
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
        if (isset($_SESSION['user']['id_user'])) {
            $id = $_SESSION['user']['id_user'] ?? null;
        } elseif (isset($data['id_user'])) {
            $id = $data['id_user'];
        } else {
            return 0;
        }

        // Validasi tanggal customDate (jika ada)
        $customDate = $data['customDate'] ?? null;
        if ($customDate) {
            // Validasi apakah string tanggal sesuai format 'YYYY-MM-DD'
            $isValidDate = preg_match('/^\d{4}-\d{2}-\d{2}$/', $customDate);
            if (!$isValidDate) {
                try {
                    $date = new DateTime($customDate);
                    $customDate = $date->format('Y-m-d'); // Ensures correct format
                } catch (Exception $e) {
                    echo 'Invalid date format provided.';
                }
            }
        }

        $query = 'UPDATE user SET nama = :nama, jenis_kelamin = :gender, tanggal_lahir = :tanggal, Instansi = :instansi, pekerjaan = :pekerjaan, kota_asal = :kota, number_phone = :telp, status = :status, alamat = :alamat WHERE id_user = :id';
        $this->db->query($query);
        $this->db->bind('nama', $data['name'] ?? null);
        $this->db->bind('gender', $data['inputGender'] ?? null);
        // $this->db->bind('tanggal', isset( $data['customDate']) ? $this->formatDate($data['customDate']) : null);
        $this->db->bind('tanggal', $customDate);
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

    public function insert($id, $status)
    {
        $query = "INSERT INTO status_user (id_user, status) VALUES (:id_user, :status)";
        $this->db->query($query);
        $this->db->bind('id_user', $id);
        $this->db->bind('status', $status);

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
        $tanggal = DateTime::createFromFormat('Y-m-d', $date);
        return $tanggal ? $tanggal->format('Y-m-d') : null;
    }

    public function getPersetujuanKos()
    {
        $query = "SELECT user.id_user, user.email, user.nama, kos.nama_kos, kos.alamat, user.kota_asal, user.number_phone, status_user.status FROM user JOIN kos ON user.id_user = kos.id_user JOIN status_user ON user.id_user = status_user.id_user WHERE status_user.status = 'pending'";

        $this->db->query($query);

        return $this->db->resultSet();
    }
    public function getPemilikKos()
    {
        $query = "SELECT id_user, nama, email, status, alamat, number_phone, tanggal_lahir, pekerjaan, kota_asal, instansi, jenis_kelamin, status_user FROM user WHERE role='pemilik kos'";
        $this->db->query($query);

        return $this->db->resultSet();
    }
    public function getPencariKos()
    {
        $query = "SELECT id_user, nama, email, status, alamat, number_phone, tanggal_lahir, pekerjaan, kota_asal, instansi, jenis_kelamin, status_user FROM user WHERE role='pencari kos'";
        $this->db->query($query);

        return $this->db->resultSet();
    }
    public function countPemilikKos()
    {
        $query = "SELECT COUNT(*) AS total FROM user WHERE role='pemilik kos'";
        $this->db->query($query);
        return $this->db->single()['total'];
    }
    public function countPencariKos()
    {
        $query = "SELECT COUNT(*) AS total FROM user WHERE role='pencari kos'";
        $this->db->query($query);
        return $this->db->single()['total'];
    }
    public function countKos()
    {
        $query = "SELECT COUNT(*) AS total FROM kos";
        $this->db->query($query);
        return $this->db->single()['total'];
    }
    public function countRating() {}
    public function getUserRegistration()
    {
        $query = "SELECT DATE(created_at) as date, COUNT(*) as total FROM user GROUP BY DATE(created_at) ORDER BY created_at DESC";
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getUserRegistrationByDate($date, $role = null)
    {
        $query = "SELECT COUNT(*) as total FROM user JOIN status_user ON user.id_user = status_user.id_user WHERE DATE(tgl_daftar) = :date";
        if ($role) {
            $query .= " AND role = :role";
        }

        $this->db->query($query);
        $this->db->bind('date', $date);

        if ($role) {
            $this->db->bind('role', $role);
        }

        return $this->db->single();
    }
    public function updateStatusPemilik($userId, $status)
    {

        $query = "UPDATE `status_user` SET `status` = :status WHERE `status_user`.`id_user` = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $userId);
        $this->db->bind('status', $status);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function createKamar($id)
    {
        do {
            $idKamar = $this->generateRandomId();
            $cekID = $this->findKamarById($idKamar);
        } while ($cekID);

        $query = "INSERT INTO kamar (id_kamar, id_kos) VALUES (:id_kamar, :id_kos)";

        $this->db->query($query);
        $this->db->bind('id_kamar', $idKamar);
        $this->db->bind('id_kos', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getFcmToken($id_user)
    {
        $query = "SELECT fcm_token FROM user WHERE id_user = :id_user";
        
        $this->db->query($query); 
        $this->db->bind(':id_user', $id_user, PDO::PARAM_INT); 
        $this->db->execute(); 
        $fcm_token = $this->db->single();
    
        return $fcm_token;
    }
    


    private function generateRandomId()
    {

        $dateTime = date('Ym');


        $randomNumber = str_pad(rand(0, 9999), 2, '0', STR_PAD_LEFT);

        $generatedId = $dateTime . $randomNumber;
        return $generatedId;
    }
}
