<?php

require_once "Database.php";

class UserModel
{
    private $connection;
    private $table = "users";

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getAllUsers()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $name, $phone)
    {
        $sql = "UPDATE " . $this->table . " SET name = :name, phone = :phone, updated_at = NOW() WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':phone', $phone);
        return $stmt->execute();
    }
}

?>