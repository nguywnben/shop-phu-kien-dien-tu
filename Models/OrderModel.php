<?php
require_once "Database.php";
class OrderModel
{
    private $connection;
    private $table = "orders";

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllOrders()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getOrderItemsByOrderId($orderId)
    {
        $sql = "SELECT oi.*, p.name as product_name_from_db 
                FROM order_items oi
                LEFT JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($orderId, $status, $paymentStatus, $shippingStatus)
    {
        $sql = "UPDATE " . $this->table . " 
                SET status = :status, payment_status = :payment_status, shipping_status = :shipping_status, updated_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        $stmt->bindValue(':payment_status', $paymentStatus, PDO::PARAM_INT);
        $stmt->bindValue(':shipping_status', $shippingStatus, PDO::PARAM_INT);
        $stmt->bindValue(':id', $orderId, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}