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
    
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            header('location: admin.php?page=orders&action=index');
            exit;
        }

        $order = $this->orderModel->getOrderById((int)$id);
        
        if (!$order) {
            header('location: admin.php?page=orders&action=index');
            exit;
        }

        $orderItems = $this->orderModel->getOrderItemsByOrderId((int)$id);
        
        require_once "Views/admin/order-edit.php";
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: admin.php?page=orders&action=index');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $status = (int)($_POST['status'] ?? 0);
        $payment_status = (int)($_POST['payment_status'] ?? 0);
        $shipping_status = (int)($_POST['shipping_status'] ?? 0);

        if (!$this->orderModel->getOrderById($id)) {
            session_start();
            $_SESSION['error'] = 'Đơn hàng không tồn tại.';
            header('location: admin.php?page=orders&action=index');
            exit;
        }

        $updated = $this->orderModel->updateOrderStatus($id, $status, $payment_status, $shipping_status);

        session_start();
        if ($updated) {
            $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công.';
        } else {
            $_SESSION['error'] = 'Cập nhật trạng thái đơn hàng thất bại.';
        }

        header('location: admin.php?page=orders&action=index');
        exit;
    }
}