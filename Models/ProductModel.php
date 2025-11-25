<?php
require_once "Database.php";
class ProductModel
{
    private $connection;
    private $table = "products";
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    public function getAllProducts()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
