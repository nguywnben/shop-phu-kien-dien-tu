<?php

require_once "Database.php";

class BrandModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllBrands()
    {
        $stmt = $this->connection->prepare("SELECT * FROM brands");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}  

?>