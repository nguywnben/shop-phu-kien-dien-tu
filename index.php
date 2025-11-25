<?php

require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

require_once 'Controllers/Client/HomeController.php';
$home = new HomeController();

switch ($page) {
    case "":
        $home->index();
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