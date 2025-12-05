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
        $stmt = $this->connection->prepare(
            "SELECT 
                p.*, 
                b.name AS brand_name,  
                (
                    SELECT url 
                    FROM product_images 
                    WHERE product_id = p.id 
                    ORDER BY sort_order ASC 
                    LIMIT 1
                ) AS main_image_url
            FROM 
                " . $this->table . " p
            JOIN 
                brands b ON p.brand_id = b.id
            WHERE 
                p.status = 1"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countProducts()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE status = 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
    public function getProductsPaginated($limit, $offset)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE status = 1 ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        $sql = "SELECT 
                    p.*, 
                    b.name AS brand_name,
                    (
                        SELECT url 
                        FROM product_images 
                        WHERE product_id = p.id 
                        ORDER BY sort_order ASC 
                        LIMIT 1
                    ) AS main_image_url
                FROM " . $this->table . " p
                JOIN brands b ON p.brand_id = b.id
                WHERE p.id = :id LIMIT 1";

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
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
