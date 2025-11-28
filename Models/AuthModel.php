<?php

require_once "Database.php";

class AuthModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function handleRegister($name, $email, $password)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password)");
            $data = [
                "name"=> $name,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function getEmailByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>