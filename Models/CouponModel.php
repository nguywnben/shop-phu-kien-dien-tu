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

    public function updateCoupon($id, $code, $max_discount, $min_order_total, $usage_limit, $start_at, $end_at, $status)
    {
        try {
            $sql = "UPDATE coupons SET 
                code = :code, 
                max_discount = :max_discount, 
                min_order_total = :min_order_total, 
                usage_limit = :usage_limit, 
                start_at = :start_at, 
                end_at = :end_at, 
                status = :status 
                WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':code' => $code,
                ':max_discount' => $max_discount,
                ':min_order_total' => $min_order_total,
                ':usage_limit' => $usage_limit,
                ':start_at' => $start_at,
                ':end_at' => $end_at,
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    /**
     * Check if a coupon code already exists.
     * If $excludeId is provided, exclude that id from the check (useful when updating).
     */
    public function existsByCode($code, $excludeId = null)
    {
        if ($excludeId !== null) {
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM coupons WHERE code = :code AND id != :id");
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        } else {
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM coupons WHERE code = :code");
            $stmt->bindParam(':code', $code);
        }

        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
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
