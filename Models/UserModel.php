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

    public function getUserById($userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function countAllUsers()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
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

    public function updateUserProfileFull($id, $name, $email, $phone, $avatar = null)
    {
        try {
            $sql = "UPDATE users SET name = :name, email = :email, phone = :phone";

            $bindings = [
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':id' => $id
            ];
            // Xử lý Avatar 
            if ($avatar !== null) {
                $sql .= ", avatar = :avatar";
                $bindings[':avatar'] = $avatar;
            }
            $sql .= " WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($bindings);
        } catch (PDOException $e) {

            return false;
        }
    }

    public function updateUser($data)
    {
        try {
            $sql = "UPDATE users SET name = :name, email = :email, phone = :phone, role = :role, status = :status, updated_at = NOW()";
            if (isset($data['avatar'])) {
                $sql .= ", avatar = :avatar";
            }
            $sql .= " WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(":phone", $data['phone'], PDO::PARAM_STR);
            $stmt->bindParam(":role", $data['role'], PDO::PARAM_INT);
            $stmt->bindParam(":status", $data['status'], PDO::PARAM_INT);
            if (isset($data['avatar'])) {
                $stmt->bindParam(":avatar", $data['avatar'], PDO::PARAM_STR);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = date('Y-m-d H:i:s') . " - Lỗi khi chỉnh sửa thành viên: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../logs/error.log', $errorMessage, FILE_APPEND);
            return false;
        }
    }
    public function getById($userId)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}  

?>