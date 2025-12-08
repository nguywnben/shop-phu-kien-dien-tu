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
                c.name AS category_name, -- Lấy tên danh mục và đặt tên là category_name
                (
                    SELECT url 
                    FROM product_images 
                    WHERE product_id = p.id 
                    ORDER BY sort_order ASC 
                    LIMIT 1
                ) AS main_image_url
            FROM 
                " . $this->table . " p
            LEFT JOIN 
                brands b ON p.brand_id = b.id
            LEFT JOIN  
                categories c ON p.category_id = c.id -- JOIN với bảng categories
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
                LEFT JOIN brands b ON p.brand_id = b.id
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
    public function updateMainImage($productId, $newUrl)
    {
        // 1. Tìm ảnh chính hiện tại (sort_order thấp nhất)
        $sqlCheck = "SELECT id FROM product_images WHERE product_id = :pid ORDER BY sort_order ASC LIMIT 1";
        $stmtCheck = $this->connection->prepare($sqlCheck);
        $stmtCheck->bindValue(':pid', $productId, PDO::PARAM_INT);
        $stmtCheck->execute();
        $mainImageId = $stmtCheck->fetchColumn();

        if ($mainImageId) {
            // 2. Nếu tìm thấy, cập nhật URL của ảnh đó
            $sqlUpdate = "UPDATE product_images SET url = :url, updated_at = NOW() WHERE id = :id";
            $stmtUpdate = $this->connection->prepare($sqlUpdate);
            $stmtUpdate->bindValue(':url', $newUrl);
            $stmtUpdate->bindValue(':id', $mainImageId, PDO::PARAM_INT);
            return $stmtUpdate->execute();
        } else {
            // 3. Nếu không tìm thấy, thêm mới một bản ghi ảnh chính (sort_order = 1)
            $sqlInsert = "INSERT INTO product_images (product_id, url, sort_order) VALUES (:pid, :url, 1)";
            $stmtInsert = $this->connection->prepare($sqlInsert);
            $stmtInsert->bindValue(':pid', $productId, PDO::PARAM_INT);
            $stmtInsert->bindValue(':url', $newUrl);
            return $stmtInsert->execute();
        }
    }
    public function updateProduct($id, $name, $sku_model, $description, $content, $price, $category_id, $brand_id, $status, $is_featured)
    {
        try {
            // Đã loại bỏ cột thumbnail khỏi câu lệnh UPDATE
            $sql = "UPDATE " . $this->table . " SET name = :name, sku_model = :sku_model, description = :description, content = :content, price = :price, category_id = :category_id, brand_id = :brand_id, status = :status, is_featured = :is_featured, updated_at = NOW() WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':sku_model' => $sku_model,
                ':description' => $description,
                ':content' => $content,
                ':price' => $price,
                ':category_id' => $category_id,
                ':brand_id' => $brand_id,
                ':status' => $status,
                ':is_featured' => $is_featured,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createProduct($name, $sku_model, $description, $content, $price, $category_id, $brand_id, $status, $is_featured)
    {
        try {
            $sql = "INSERT INTO " . $this->table . " (name, sku_model, description, content, price, category_id, brand_id, status, is_featured, created_at) 
                    VALUES (:name, :sku_model, :description, :content, :price, :category_id, :brand_id, :status, :is_featured, NOW())";

            $stmt = $this->connection->prepare($sql);
            $success = $stmt->execute([
                ':name' => $name,
                ':sku_model' => $sku_model,
                ':description' => $description,
                ':content' => $content,
                ':price' => $price,
                ':category_id' => $category_id,
                ':brand_id' => $brand_id,
                ':status' => $status,
                ':is_featured' => $is_featured
            ]);


            if ($success) {
                return $this->connection->lastInsertId();
            }
            return false;

        } catch (PDOException $e) {
            return false;
        }
    }

    // Phương thức thêm URL ảnh chính vào bảng product_images (sort_order = 1)
    public function insertMainImage($productId, $url)
    {
        try {
            $sql = "INSERT INTO product_images (product_id, url, sort_order) VALUES (:pid, :url, 1)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':pid', $productId, PDO::PARAM_INT);
            $stmt->bindValue(':url', $url);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function checkNameExists($name, $ignoreId = null)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE name = :name";

        // Nếu cung cấp $ignoreId (đang sửa), loại trừ bản ghi đó
        if ($ignoreId !== null) {
            $sql .= " AND id != :ignoreId";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $name);

        if ($ignoreId !== null) {
            $stmt->bindParam(':ignoreId', $ignoreId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu tên đã tồn tại
    }
}
