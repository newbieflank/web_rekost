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
        $query = "INSERT INTO user (id_user, nama, email, password, role) VALUES (:id, :nama, :email, :pass, :role)";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', $data['password']);
        $this->db->bind('role', $data['role']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function getSchools()
    {
        $query = "SELECT id, name FROM schools";
        $this->db->query($query);
        $school = $this->db->resultSet();

        return $school;
    }

    public function insertNewSchool()
    {
        $this->db->query("INSERT INTO schools (name) VALUES (:name)");
        $this->db->bind(':name', 'New School Name');
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateProfile($data)
    {
        $id = isset($_SESSION['user']['id_user']) ? $_SESSION['user']['id_user'] : null;
        if (!$id) {
            echo "User ID not found in session.";
            return;
        }

        $nama = isset($data['name']) ? $data['name'] : null;
        $gender = isset($data['inputGender']) ? $data['inputGender'] : null;
        $tanggal = isset($data['customDate']) ? $this->getDate($data['customDate']) : null;
        $pekerjaan = isset($data['pekerjaan']) ? $data['pekerjaan'] : null;
        $instansi = isset($data['inputInstansi']) ? $data['inputInstansi'] : null;
        $kota = isset($data['kotaAsal']) ? $data['kotaAsal'] : null;
        $telp = isset($data['noTelp']) ? $data['noTelp'] : null;
        $status = isset($data['status']) ? $data['status'] : null;
        $alamat = isset($data['alamat']) ? $data['alamat'] : null;

        $query = 'UPDATE user SET nama=:nama, jenis_kelamin=:gender, tanggal_lahir=:tanggal, Instansi=:instansi, pekerjaan=:pekerjaan, kota_asal=:kota, number_phone=:telp, status=:status, alamat=:alamat WHERE id_user=:id';
        $this->db->query($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('gender', $gender);
        $this->db->bind('tanggal', $tanggal);
        $this->db->bind('pekerjaan', $pekerjaan);
        $this->db->bind('instansi', $instansi);
        $this->db->bind('kota', $kota);
        $this->db->bind('telp', $telp);
        $this->db->bind('status', $status);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }



    private function getDate($date)
    {
        $tanggal = DateTime::createFromFormat('d-F-Y', $date);
        $date = $tanggal ? $tanggal->format('Y-m-d') : null;

        return $date;
    }
    
    public function createKos1($data)
{
    $query = "INSERT INTO detail_kos (id_kos,nama_kos, harga_kos,deskripsi,tipe_kos,alamat,waktu_bayar,latitude,longititude,jumlah_kamar,id_kamar,id_fasilitas_umum,id_peraturan_kos,id_user
    ) VALUES (:id_kos,:nama_kos,:harga_kos,:deskripsi,:tipe_kos,:alamat,:waktu_bayar,:latitude,:longititude,:jumlah_kamar,:id_kamar,:id_fasilitas_umum,:id_peraturan_kos,:id_user)";

    $this->db->query($query);
    $this->db->bind('id_kos', $data['id_kos']);
    $this->db->bind('nama_kos', $data['nama_kos']);
    $this->db->bind('harga_kos', $data['harga_kos']);
    $this->db->bind('deskripsi', $data['deskripsi']);
    $this->db->bind('tipe_kos', $data['tipe_kos']);
    $this->db->bind('alamat', $data['alamat']);
    $this->db->bind('waktu_bayar', $data['waktu_bayar']);
    $this->db->bind('latitude', $data['latitude']);
    $this->db->bind('longititude', $data['longititude']);
    $this->db->bind('jumlah_kamar', $data['jumlah_kamar']);
    $this->db->bind('id_kamar', $data['id_kamar']);
    $this->db->bind('id_fasilitas_umum', $data['id_fasilitas_umum']);
    $this->db->bind('id_peraturan_kos', $data['id_peraturan_kos']); 
    $this->db->bind('id_user', $data['id_user']);

    $this->db->execute();

    return $this->db->rowCount();
}

}
