<?php
require_once "Database.php";
class CategoryModel
{
    private $connection;
    private $table = "categories";
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    public function getAllCategories()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}  