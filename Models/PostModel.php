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
}  

?>