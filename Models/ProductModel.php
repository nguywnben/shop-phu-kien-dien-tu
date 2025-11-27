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
    public function getById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getImagesByProductId($productId)
    {
        $sql = "SELECT url FROM product_images WHERE product_id = :pid ORDER BY sort_order ASC";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':pid', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
