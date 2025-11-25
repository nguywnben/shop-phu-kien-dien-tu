<?php

class Database
{
    private $db_host=DB_HOST;
    private $db_user=DB_USER;
    private $db_pass=DB_PASS;
    private $db_name=DB_NAME;
    private $connection;

    public function __construct($db_host=DB_HOST, $db_user=DB_USER, $db_pass=DB_PASS, $db_name=DB_NAME)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}

?>