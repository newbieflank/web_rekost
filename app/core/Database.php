<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stm;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function query($query)
    {
        try {
            $this->stm = $this->dbh->prepare($query);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function bind($params, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        try {
            $this->stm->bindValue($params, $value, $type);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function execute()
    {
        try {
            return $this->stm->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function resultSet()
    {
        try {
            $this->execute();
            return $this->stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function single()
    {
        try {
            $this->execute();
            return $this->stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function rowCount()
    {
        try {
            return $this->stm->rowCount();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    private function handleError($e)
    {

        error_log('Database Error: ' . $e->getMessage());
        die('An error occurred while interacting with the database.');
    }
}
