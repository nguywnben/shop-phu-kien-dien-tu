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

    public function getAllCouponsPaginated($limit, $offset)
    {
        $sql = "SELECT * FROM coupons ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCoupons()
    {
        $sql = "SELECT COUNT(*) FROM coupons";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
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

    public function createCoupon($code, $maxDiscount, $minOrderTotal, $usageLimit, $startAt, $endAt, $status = 1)
    {
        try {
            $sql = "INSERT INTO coupons (code, max_discount, min_order_total, usage_limit, start_at, end_at, status) VALUES (:code, :max_discount, :min_order_total, :usage_limit, :start_at, :end_at, :status)";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':code' => $code,
                ':max_discount' => $maxDiscount,
                ':min_order_total' => $minOrderTotal,
                ':usage_limit' => $usageLimit,
                ':start_at' => $startAt ? $startAt : null, 
                ':end_at' => $endAt ? $endAt : null, 
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
