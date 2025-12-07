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

    public function createPasswordResetToken($email, $token, $expires_at)
    {
        try {
            $this->conn->prepare("DELETE FROM password_resets WHERE email = :email")->execute(['email' => $email]);
            $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires_at)";
            $stmt = $this->conn->prepare($sql);
            $data = [
                "email" => $email,
                "token" => $token,
                "expires_at" => $expires_at,
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getTokenData($token)
    {
        $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updatePassword($email, $new_password_hash)
    {
        try {
            $sql = "UPDATE users SET password_hash = :password_hash WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $data = [
                "password_hash" => $new_password_hash,
                "email" => $email,
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function deleteToken($token)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM password_resets WHERE token = :token");
            $stmt->bindParam(":token", $token);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>