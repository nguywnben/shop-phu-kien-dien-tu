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
                    p.thumbnail,
                    p.status,
                    p.sku_model
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
}