<?php

// Yêu cầu các Model mới
require_once "Models/UserModel.php";
require_once "Models/OrderModel.php";

class DashboardController {
    
    private $userModel;
    private $orderModel;

    public function __construct() {
        // Khởi tạo Models
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
    }
    
    public function index() {
        
 
        $totalUsers = $this->userModel->countAllUsers();

      
        $totalOrders = $this->orderModel->countOrders();

        
        $formattedUsers = number_format($totalUsers);
        $formattedOrders = number_format($totalOrders);

   
        
        include "Views/admin/index.php"; // File View
    }
}

?>