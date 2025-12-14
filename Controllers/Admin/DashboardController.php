<?php

// Yêu cầu các Model mới
require_once "Models/UserModel.php";
require_once "Models/OrderModel.php";
require_once "Models/DashboardModel.php";

class DashboardController
{

    private $userModel;
    private $orderModel;

    private $_dashboard;

    public function __construct()
    {
        // Khởi tạo Models
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->_dashboard = new DashboardModel();
    }

    public function index()
    {
        // $year = ($_GET['year'] ?? date(format: 'Y'));
        $orderSuccessCount = $this->_dashboard->getOrderSuccessCountinYear(2, null);

        $labels = array_column($orderSuccessCount, 'month');
        $data = array_column($orderSuccessCount, 'Total_orders');

        $months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        $finalData = [];
        foreach ($months as $m) {
            $index = array_search($m, $labels);
            // SỬA: $data[$index] ở đây vẫn chưa được ép kiểu, dẫn đến lỗi trục Y.
            $finalData[] = $index !== false ? (int)$data[$index] : 0;
        }

        $totalUsers = $this->userModel->countAllUsers();


        $totalOrders = $this->orderModel->countOrders();


        $formattedUsers = number_format($totalUsers);
        $formattedOrders = number_format($totalOrders);



        include "Views/admin/index.php"; // File View
    }
}

?>