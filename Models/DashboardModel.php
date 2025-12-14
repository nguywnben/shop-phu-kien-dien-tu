<?php
   require_once "Database.php";
class DashboardModel
{
    private $connection;
    private $table = "dashboard";

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }
    
    public function getOrderSuccessCountinYear(int $shipping_status = 2,?int $year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }
       $sql = "SELECT DATE_FORMAT(created_at, '%m') as month, COUNT(*) AS Total_orders
                FROM orders
                WHERE shipping_status = :shipping_status AND YEAR(created_at) = :year
                GROUP BY month 
                ORDER BY month";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':shipping_status', (int)$shipping_status, PDO::PARAM_INT);
        $stmt->bindValue(':year', (int)$year, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
}

?>
