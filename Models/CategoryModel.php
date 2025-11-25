<?php

require_once "Database.php";

class CategoryModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllCategories()
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveCategories()
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>