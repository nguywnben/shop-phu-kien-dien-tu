<?php

require_once "Database.php";

class PostModel
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllPosts()
    {
        $stmt = $this->connection->prepare("SELECT * FROM blog");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPostsPaginated($limit, $offset)
    {
        $sql = "SELECT * FROM blog ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPosts()
    {
        $sql = "SELECT COUNT(*) FROM blog";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function getActivePosts()
    {
        $stmt = $this->connection->prepare("SELECT * FROM blog WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM blog WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $slug, $content, $coverImage, $authorId, $status = 1)
    {
        try {
            $sql = "INSERT INTO blog (title, slug, content, cover_image, author_id, status, published_at, created_at, updated_at) 
                    VALUES (:title, :slug, :content, :cover_image, :author_id, :status, :published_at, NOW(), NOW())";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([
                ':title' => $title,
                ':slug' => $slug,
                ':content' => $content,
                ':cover_image' => $coverImage,
                ':author_id' => $authorId,
                ':status' => $status,
                ':published_at' => $status == 1 ? date('Y-m-d H:i:s') : null
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function updatePost($data)
{
    try {
        $stmt = $this->connection->prepare("
            UPDATE blog 
            SET 
                title = :title, 
                slug = :slug, 
                content = :content, 
                cover_image = :cover_image,
                author_id = :author_id,
                status = :status ,
                published_at = :published_at,
                created_at = :created_at,
                updated_at = :updated_at
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':cover_image', $data['cover_image']);
        $stmt->bindParam(':author_id', $data['author_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':published_at', $data['published_at']);
        $stmt->bindParam(':created_at', $data['created_at']);
        $stmt->bindParam(':updated_at', $data['updated_at']);

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
            $sql = "DELETE FROM blog WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            var_dump( $e->getMessage());
        }
    }
}  

?>