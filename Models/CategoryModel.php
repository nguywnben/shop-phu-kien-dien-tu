
<?php

require_once "Database.php";

class CategoryModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
 public function getAllCategories() : array
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
 }

    public function countCategories()
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM categories");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getCategoriesPaginated($limit, $offset)
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getActiveCategories()
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOneCategory($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateCategory($id, $image, $name, $status)
    {
        try {

            $sql = "UPDATE categories SET image = :image, name = :name, status = :status WHERE id = :id";
            $stmt = $this->connection->prepare($sql);

            return $stmt->execute([
                ':id' => $id,
                ':image' => $image,
                ':name' => $name,
                ':status' => $status
            ]);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            return false;
        }

    }

    /**
     * Check if a category name already exists.
     * If $excludeId is provided, exclude that id from the check (useful when updating).
     */
    public function existsByName($name, $excludeId = null)
    {
        if ($excludeId !== null) {
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM categories WHERE name = :name AND id != :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        } else {
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM categories WHERE name = :name");
            $stmt->bindParam(':name', $name);
        }

        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function insert($name, $image, $status)
    {
        try {
            $sql = "INSERT INTO categories (name, image, status, create_at, update_at) VALUES (:name, :image, :status, NOW(), NOW())";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':image' => $image,
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
    public function checkName()
    {
        try {
            $sql = "SELECT name FROM categories";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOexception $e) {
            var_dump($e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM categories WHERE id=:id";
            $stmt = $this->connection->prepare($sql);

            $categories = $stmt->execute([':id' => $id]);
            return $categories;

        } catch (PDOexception $e) {
            var_dump($e->getMessage());
        }
    }
}

?>