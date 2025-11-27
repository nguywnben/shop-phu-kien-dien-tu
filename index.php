<?php

require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
require_once 'Controllers/Client/ShopController.php';
require_once 'Controllers/Client/HomeController.php';
$home = new HomeController();
$shop = new ShopController();

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
        }
        break;
    default:
        echo "Không tìm thấy trang.";
        break;
}

?>