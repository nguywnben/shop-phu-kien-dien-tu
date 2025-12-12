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
require_once "Controllers/Admin/BrandController.php";
$brand = new BrandController();
require_once "Controllers/Admin/PostController.php";
$post = new PostController();
require_once "Controllers/Admin/BrandController.php";
$brand = new BrandController();

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
            case 'store':
                $category->store();
                break;
            case 'delete':
                $category->delete();
                break;
            case 'add':
                $category->add();
                break;
        }
        break;
    case "products":
        switch ($action) {
            case "index":
                $product->index();
                break;
            case "add":
                $product->add();
                break;
            case "store":
                $product->store();
                break;
            case "edit":
                $product->edit();
                break;
            case "delete":
                $product->delete();
                break;
            case "update":
                $product->update();
                break;
        }
        break;
    case "coupons":
        switch ($action) {
            case "index":
                $coupon->index();
                break;
            case "add":
                $coupon->add();
                break;
            case "store":
                $coupon->store();
                break;
            case "edit":
                $coupon->edit();
                break;
            case "update":
                $coupon->update();
                break;
            case 'delete':
                $coupon->delete();
                break;
        }
        break;
    case "orders":
        switch ($action) {
            case "index":
                $order->index();
                break;
            case "edit":
                $order->edit();
                break;
            case "update":
                $order->update();
                break;
        }
        break;
    case "brands":
        switch ($action) {
            case "index":
                $brand->index();
                break;
             case "delete":
                $brand->delete();
                break;
            case "edit":
                $brand->edit();
                break;
            case "update":
                $brand->update();
                break;
            case "add":
                $brand->add();
                break;
            case "store":
                $brand->store();
                break;
        }
        break;
    case "posts":
        switch ($action) {
            case "index":
                $post->index();
                break;
            case "edit":
                $post->edit();
                break;
            case "update":
                $post->update();
                break;
            case 'delete':
                $post->delete();
                break;
        }
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require_once "Views/admin/404.php";
        break;


}


?>