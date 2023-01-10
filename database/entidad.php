<?php

require_once 'model/session.php';

class entidadBase
{
    private $table;
    private $db;
    private $conectar;
    public $result;
    public $session;

    public function __construct($table)
    {
        $this->table = (string) $table;
        $this->conectar = null;
        $this->db = Database::StartUp();
        $this->session = new Session();
    }

    public function getConetar()
    {
        return $this->conectar;
    }

    public function db()
    {
        return $this->db;
    }

    public function getAll()
    {
        return mysqli_query($this->db, "SELECT * FROM $this->table");
    }

    public function getById($id)
    {
        $result = mysqli_query($this->db, "SELECT * FROM $this->table WHERE id = $id");
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function save($query)
    {
        mysqli_query($this->db, $query, MYSQLI_USE_RESULT);
        $_SESSION['lastId'] = mysqli_insert_id($this->db);
        $_SESSION['error'] = mysqli_error($this->db);
        return mysqli_insert_id($this->db);
    }

}
