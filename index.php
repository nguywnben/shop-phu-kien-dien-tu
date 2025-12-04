<?php

session_start();

require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
require_once 'Controllers/Client/ShopController.php';
$shop = new ShopController();
require_once 'Controllers/Client/HomeController.php';
$home = new HomeController();
require_once "Controllers/Client/AuthController.php";
$auth = new AuthController();

switch ($page) {
    case "":
        $home->index();
        break;
    case "shop":
        $shop->index();
        break;
    case "details":
        $shop->details();
        break;
    case "login":
        switch ($action) {
            case "index":
                $auth->login();
                break;
            case "handle":
                $auth->handleLogin();
                break;
        }
        break;
    case "register":
        switch ($action) {
            case "index":
                $auth->register();
                break;
            case "handle":
                $auth->handleRegister();
                break;
        }
        break;
    case "logout":
        $auth->logout();
        break;
    default:
        echo "Không tìm thấy trang.";
        break;
}

?>