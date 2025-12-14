<?php
require_once "Database.php";

class WishlistModel
{
    private $connection;
    private $table = "wishlist";

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    public function getWishlistByUserId($userId)
    {
        $sql = "SELECT 
                    w.id as wishlist_id,
                    w.user_id,
                    w.product_id,
                    w.variant_id,
                    w.added_at,
                    p.id,
                    p.name,
                    p.description,
                    p.price,
                    p.status,
                    p.sku_model,
                    (
                        SELECT url 
                        FROM product_images 
                        WHERE product_id = p.id 
                        ORDER BY sort_order ASC 
                        LIMIT 1
                    ) AS main_image_url
                FROM " . $this->table . " w
                INNER JOIN products p ON w.product_id = p.id
                WHERE w.user_id = :user_id
                ORDER BY w.added_at DESC";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countWishlistItems($userId)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
    public function removeFromWishlist($wishlistId, $userId)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id AND user_id = :user_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $wishlistId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addToWishlist($userId, $productId, $variantId = null)
    {
        // Check if product already exists in wishlist
        $checkSql = "SELECT id FROM " . $this->table . " WHERE user_id = :user_id AND product_id = :product_id";
        $checkStmt = $this->connection->prepare($checkSql);
        $checkStmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $checkStmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            return ['success' => false, 'message' => 'Sản phẩm đã có trong danh sách yêu thích'];
        }

        $sql = "INSERT INTO " . $this->table . " (user_id, product_id, variant_id, added_at) 
                VALUES (:user_id, :product_id, :variant_id, NOW())";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindValue(':variant_id', $variantId);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Đã thêm vào danh sách yêu thích'];
        }
        return ['success' => false, 'message' => 'Không thể thêm sản phẩm'];
    }

    public function isInWishlist($userId, $productId)
    {
        $sql = "SELECT id FROM " . $this->table . " WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}