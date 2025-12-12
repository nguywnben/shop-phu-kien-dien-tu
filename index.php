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
require_once "Controllers/Client/WishlistController.php";
$wishlist = new WishlistController();
require_once "Controllers/Client/AccountController.php";
$account = new AccountController();

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
    case "wishlist":
        $wishlist->index();
        break;
    case "account":
        switch ($action) {
            case "index":
            case "":
                $account->index();
                break;
            case "update":
                $account->update();
                break;
        }
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
    case "forgot-password":
        switch ($action) {
            case "index":
                $auth->forgotPassword();
                break;
            case "handle":
                $auth->handleForgotPassword();
                break;
        }
        break;
    case "reset-password":
        switch ($action) {
            case "index":
                $auth->resetPassword();
                break;
            case "handle":
                $auth->handleResetPassword();
                break;
        }
        break;
    case "logout":
        $auth->logout();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require_once "Views/client/404.php";
        break;
}

?>