<?php
require_once "Database.php";
class CouponModel
{
    private $connection;
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    public function getAllCoupons()
    {
        $stmt = $this->connection->prepare("SELECT * FROM coupons");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
