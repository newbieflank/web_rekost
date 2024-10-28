<?php

class ImageModel extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($id, $gambar)
    {
        $query = 'INSERT INTO gambar (id_gambar, gambar) VALUES (:id, :gambar); UPDATE user SET id_gambar=:Idgambar;';
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('Idgambar', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getId($data)
    {

        $query = 'SELECT id_gambar FROM user WHERE id_user=:id';
        $this->db->query($query);
        $this->db->bind('id', $data);

        return $this->db->single();
    }
}
