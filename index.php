<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
require_once 'config.php';
require_once 'Controllers/Client/HomeController.php';
$homeController = new HomeController();
switch ($page) {
    case 'home':
        switch ($action) {
            case 'index':
                $homeController->index();
                break;
            default:
                echo "Action not found.";
                break;
        }
        break;
    default:
        echo "Page not found.";
        break;
}
?>