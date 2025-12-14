

<?php

require_once "Database.php";

class BrandModel
{
    private $connection;
    private $table = "brands";

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllBrands()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        // Đếm tổng số thương hiệu
    public function countBrands()
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM " . $this->table);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public $lastError = null;

    // Lấy thương hiệu theo phân trang
    public function getBrandsPaginated($limit, $offset)
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Phương thức LẤY THƯƠNG HIỆU THEO ID
    public function getById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateBrand($id, $name, $slug, $logo_url, $status)
    {
        try {
            $sql = "UPDATE " . $this->table . " SET name = :name, slug = :slug, logo = :logo, status = :status, updated_at = NOW() WHERE id = :id";
            $stmt = $this->connection->prepare($sql);

            return $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':slug' => $slug,
                ':logo' => $logo_url, // URL/tên file logo
                ':status' => $status,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteBrand($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function createBrand($name, $slug, $logo_url, $status)
    {
        $this->lastError = null;
        try {
            $sql = "INSERT INTO " . $this->table . " (name, slug, logo, status, created_at, updated_at) 
                    VALUES (:name, :slug, :logo, :status, NOW(), NOW())";

            $stmt = $this->connection->prepare($sql);

            return $stmt->execute([
                ':name' => $name,
                ':slug' => $slug,
                ':logo' => $logo_url,
                ':status' => $status,
            ]);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
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
        // Kiểm tra slug đã tồn tại chưa
    public function checkSlugExists($slug, $ignoreId = null)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE slug = :slug";
        if ($ignoreId !== null) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':slug', $slug);
        if ($ignoreId !== null) {
            $stmt->bindParam(':ignoreId', $ignoreId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}

?>