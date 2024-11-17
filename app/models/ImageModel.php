<?php

class ImageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($id, $idGambar)
    {
        try {
            $query = "UPDATE user SET id_gambar=:idGambar WHERE id_user=:id";
            $this->db->query($query);
            $this->db->bind(':idGambar', $idGambar);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            echo $e . '</br>';
            return 0;
        }
    }

    public function getImageByUserId($data)
    {

        $query = 'SELECT id_gambar FROM user WHERE id_user=:id';
        $this->db->query($query);
        $this->db->bind('id', $data);

        return $this->db->single();
    }
}
