<?php
session_start();
// if ($_SESSION["login"]["role"] != 1) {
//     header("Location: index.php");
//     exit;
// }

require_once 'config.php';

$page = isset($_GET["page"]) ? $_GET["page"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";

require_once "Controllers/Admin/DashboardController.php";
$dashboard = new DashboardController();
require_once "Controllers/Admin/UserController.php";
$user = new UserController();
require_once "Controllers/Admin/CategoryController.php";
$category = new CategoryController();
require_once "Controllers/Admin/ProductController.php";
$product = new ProductController();
require_once "Controllers/Admin/CouponController.php";
$coupon = new CouponController();
require_once "Controllers/Admin/OrderController.php";
$order = new OrderController();

switch ($page) {
    case "":
        $dashboard->index();
        break;
    case "users":
        switch ($action) {
            case "index":
                $user->index();
                break;
        }
        break;
    case "categories":
        switch ($action) {
            case "index":
                $category->index();
                break;
            case "edit":
                $category->edit();
                break;
             case "update":
                $category->update();
                break;   
                case 'delete':
                $category->delete();
                break;
        }
        break;
    case "products":
        switch ($action) {
            case "index":
                $product->index();
                break;
        }
        break;
    case "coupons":
        switch ($action) {
            case "index":
                $coupon->index();
                break;
        }
    case "orders":
        switch ($action) {
            case "index":
                $order->index();
                break;
        }
        break;
    default:
        echo "Không tìm thấy trang.";
        break;
}

?>