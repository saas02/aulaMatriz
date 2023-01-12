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

    public function deleteById($ids)
    {        
        return mysqli_query($this->db, "DELETE FROM $this->table WHERE id IN (".implode(', ', $ids).")");
    }

    public function save($querys)
    {
        unset($_SESSION['errors']);
        mysqli_begin_transaction($this->db);

        $result = [];

        try {

            
            foreach ($querys as $query) {
                mysqli_query($this->db, $query, MYSQLI_USE_RESULT);
                $result[] = mysqli_insert_id($this->db);
            }            
            
            mysqli_commit($this->db);

            
        } catch (mysqli_sql_exception $exception) {
            
            mysqli_rollback($this->db);
            $_SESSION['errors'] = $exception->getMessage();            
        }        

        return $result;

    }

}