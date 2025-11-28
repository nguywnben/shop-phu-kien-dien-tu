<?php

require_once "Models/AuthModel.php";

class AuthController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        include "Views/client/login.php";
    }

    public function handleLogin()
    {
        if (!isset($_POST["login"])) {
            header("location: index.php?page=login&action=index");
            exit;
        }

        $errors = [];
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        if ($email === "") {
            $errors["email"] = "Địa chỉ email không được để trống.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Địa chỉ email không hợp lệ (ví dụ: ten@domain.com).";
        }

        if ($password === "") {
            $errors["password"] = "Mật khẩu không được để trống.";
        } elseif (strlen($password) < 8 || strlen($password) > 16) {
            $errors["password"] = "Mật khẩu phải từ 8 đến 16 ký tự.";
        } elseif (
            !preg_match("/[A-Z]/", $password) ||
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[0-9]/", $password) ||
            !preg_match("/[\W_]/", $password)
        ) {
            $errors["password"] = "Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.";
        } elseif (preg_match("/\s/", $password)) {
            $errors["password"] = "Mật khẩu không được chứa khoảng trắng.";
        }

        if (empty($errors)) {
            $user = $this->authModel->getEmailByEmail($email); 
            
            if (!$user) {
                $errors["email"] = "Địa chỉ email không tồn tại.";
            } elseif (!password_verify($password, $user["password_hash"])) {
                $errors["password"] = "Mật khẩu không đúng.";
            }
        }

        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["old_data"] = $_POST;
            $_SESSION["failed"] = "Đăng nhập tài khoản thất bại.";
            header("location: index.php?page=login&action=index");
            exit;
        }

        if ($user) {
            $_SESSION["login"] = $user;
            $_SESSION["success"] = "Đăng nhập thành công!";
            header("location: index.php");
            exit;
        }
    }

    public function register()
    {
        include "Views/client/register.php";
    }

    public function handleRegister()
    {
        if (!isset($_POST["register"])) {
            header("location: index.php?page=register&action=index");
            exit;
        }
        $errors = [];
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        $repassword = $_POST["repassword"] ?? "";
        $emailUser = $this->authModel->getEmailByEmail($email);
        if ($name === "") {
            $errors["name"] = "Họ và tên không được để trống.";
        } elseif (preg_match("/[0-9]/", $name)) {
            $errors["name"] = "Họ và tên không được chứa số.";
        } elseif (preg_match("/[~!@#$%^&*()+={}\[\]|\\:;\"'<,>.?\/]/", $name)) {
            $errors["name"] = "Họ và tên không được chứa ký tự đặc biệt.";
        }
        if ($email === "") {
            $errors["email"] = "Địa chỉ email không được để trống.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Địa chỉ email không đúng định dạng.";
        } elseif ($emailUser) {
            $errors["email"] = "Địa chỉ email đã tồn tại.";
        }
        if ($password === "") {
            $errors["password"] = "Mật khẩu không được để trống.";
        } elseif (strlen($password) < 8 || strlen($password) > 16) {
            $errors["password"] = "Mật khẩu phải từ 8 đến 16 ký tự.";
        } elseif (
            !preg_match("/[A-Z]/", $password) ||
            !preg_match("/[a-z]/", $password) ||
            !preg_match("/[0-9]/", $password) ||
            !preg_match("/[\W_]/", $password)
        ) {
            $errors["password"] = "Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.";
        } elseif (preg_match("/\s/", $password)) {
            $errors["password"] = "Mật khẩu không được chứa khoảng trắng.";
        }
        if ($repassword === "") {
            $errors["repassword"] = "Mật khẩu không được để trống.";
        } elseif (strlen($repassword) < 8 || strlen($repassword) > 16) {
            $errors["repassword"] = "Mật khẩu phải từ 8 đến 16 ký tự.";
        } elseif (
            !preg_match("/[A-Z]/", $repassword) ||
            !preg_match("/[a-z]/", $repassword) ||
            !preg_match("/[0-9]/", $repassword) ||
            !preg_match("/[\W_]/", $repassword)
        ) {
            $errors["repassword"] = "Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.";
        } elseif (preg_match("/\s/", $repassword)) {
            $errors["repassword"] = "Mật khẩu không được chứa khoảng trắng.";
        } elseif ($repassword != $password) {
            $errors["repassword"] = "Mật khẩu không giống nhau.";
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["old_data"] = $_POST;
            $_SESSION["failed"] = "Đăng ký tài khoản thất bại.";
            header("location: index.php?page=register&action=index");
            exit;
        }
        $result = $this->authModel->handleRegister($name, $email, $password);
        if ($result) {
            $_SESSION["successful"] = "Đăng ký tài khoản thành công.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function logout(){
        unset($_SESSION["login"]);
        header("location: index.php");
        exit;
    }
}

?>