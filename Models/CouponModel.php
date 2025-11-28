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
    public function getActiveCoupons()
    {
        $stmt = $this->connection->prepare("SELECT * FROM coupons WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCouponById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM coupons WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCoupon($code, $discount, $type, $expiry_date, $status = 1)
    {
        try {
            $sql = "INSERT INTO coupons (code, discount, type, expiry_date, status) VALUES (:code, :discount, :type, :expiry_date, :status)";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':code' => $code,
                ':discount' => $discount,
                ':type' => $type,
                ':expiry_date' => $expiry_date, 
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function updateCoupon($data)
{
    try {
        $stmt = $this->connection->prepare("
            UPDATE coupons 
            SET 
                max_discount = :max_discount, 
                min_order_total = :min_order_total, 
                usage_limit = :usage_limit, 
                start_at = :start_at, 
                end_at = :end_at, 
                status = :status 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':max_discount', $data['max_discount']);
        $stmt->bindParam(':min_order_total', $data['min_order_total']);
        $stmt->bindParam(':usage_limit', $data['usage_limit']);
        $stmt->bindParam(':start_at', $data['start_at']);
        $stmt->bindParam(':end_at', $data['end_at']);
        $stmt->bindParam(':status', $data['status']);

        $stmt->execute();
        return true;
        } catch (PDOException $e) {
        var_dump($e->getMessage());
        return false;
    }
}

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM coupons WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            var_dump( $e->getMessage());
        }
    }
}
