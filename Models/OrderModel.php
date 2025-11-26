<?php
require_once "Database.php";
class OrderModel
{
    private $connection;
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    public function getAllOrders()
    {
        $stmt = $this->connection->prepare("SELECT * FROM orders");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
