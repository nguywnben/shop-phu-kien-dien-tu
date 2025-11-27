<?php

require_once "Models/OrderModel.php";

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $orders = $this->orderModel->getAllOrders();
        require_once "Views/admin/orders-index.php";
    }
    
}

?>