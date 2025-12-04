<?php
require_once "Database.php";

class WishlistModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function wishlist()
    {
        $stmt = $this->connection->prepare("SELECT * FROM wishlist");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}