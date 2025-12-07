<?php

require_once "Models/AuthModel.php";
require_once 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        }
        if ($password === "") {
            $errors["password"] = "Mật khẩu không được để trống.";
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

    function forgotPassword()
    {
        include "Views/client/forgot-password.php";
    }

    public function handleForgotPassword()
    {
        if (!isset($_POST["forgot-password"])) {
            header("location: index.php?page=forgot-password&action=index");
            exit;
        }
        $errors = [];
        $email = $_POST["email"] ?? "";
        $user = $this->authModel->getEmailByEmail($email);
        if ($email === "") {
            $errors["email"] = "Địa chỉ email không được để trống.";
        } elseif (!$user) {
            $errors["email"] = "Địa chỉ email không tồn tại.";
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["old_data"] = $_POST;
            $_SESSION["failed"] = "Yêu cầu đặt lại mật khẩu thất bại.";
            header("location: index.php?page=forgot-password&action=index");
            exit;
        }
        $token = bin2hex(random_bytes(32));
        $expires_at = date("Y-m-d H:i:s", time() + 1800);
        $create_success = $this->authModel->createPasswordResetToken($email, $token, $expires_at);
        if ($create_success) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'nben65206@gmail.com';
                $mail->Password   = 'vxnl abzn xzdy mlpy';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('no-reply@gearzone.com', 'GearZone');
                $mail->addAddress($email, $user["name"] ?? $email);
                $reset_link = "http://localhost/shop-phu-kien-dien-tu/index.php?page=reset-password&action=index&token=" . $token;
                $mail->isHTML(true);
                $mail->Subject = 'Yêu cầu đặt lại mật khẩu';
                $mail->Body    = "Xin chào " . htmlspecialchars($user["name"] ?? $email) . ",<br><br>"
                                . "Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.<br>"
                                . "Vui lòng nhấp vào liên kết sau để đặt lại mật khẩu của bạn:<br><br>"
                                . "<a href='{$reset_link}'>Đặt lại mật khẩu của tôi</a><br><br>"
                                . "Liên kết này sẽ hết hạn sau 30 phút. Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.";
                $mail->AltBody = "Để đặt lại mật khẩu, vui lòng truy cập liên kết sau: " . $reset_link;
                $mail->send();
                $_SESSION["successful"] = "Liên kết đặt lại mật khẩu đã được gửi đến email của bạn. Vui lòng kiểm tra hộp thư đến và cả mục Spam.";
                header("location: index.php?page=forgot-password&action=index");
                exit;
            } catch (Exception $e) {
                $_SESSION["failed"] = "Đã xảy ra lỗi khi gửi email. Vui lòng thử lại sau.";
                header("location: index.php?page=forgot-password&action=index");
                exit;
            }
        } else {
            $_SESSION["failed"] = "Đã xảy ra lỗi hệ thống. Vui lòng thử lại sau.";
            header("location: index.php?page=forgot-password&action=index");
            exit;
        }
    }

    public function resetPassword()
    {
        $token = $_GET["token"] ?? "";
        $tokenData = $this->authModel->getTokenData($token);
        if (!$tokenData || strtotime($tokenData["expires_at"]) < time()) {
            $_SESSION["failed"] = "Liên kết đặt lại mật khẩu không hợp lệ hoặc đã hết hạn. Vui lòng yêu cầu đặt lại mật khẩu mới.";
            header("location: index.php?page=forgot-password&action=index");
            exit;
        }
        include "Views/client/reset-password.php";
    }

    public function handleResetPassword()
    {
        if (!isset($_POST["reset-password"])) {
            header("location: index.php?page=login&action=index");
            exit;
        }
        $errors = [];
        $token = $_POST["token"] ?? "";
        $password = $_POST["password"] ?? "";
        $repassword = $_POST["repassword"] ?? "";
        $tokenData = $this->authModel->getTokenData($token);
        if (!$tokenData || strtotime($tokenData["expires_at"]) < time()) {
            $_SESSION["failed"] = "Liên kết đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.";
            header("location: index.php?page=forgot-password&action=index");
            exit;
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
        } elseif ($repassword != $password) {
            $errors["repassword"] = "Mật khẩu không giống nhau.";
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["failed"] = "Đặt lại mật khẩu thất bại.";
            header("location: index.php?page=reset-password&action=index&token=" . $token);
            exit;
        }
        $email = $tokenData["email"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_success = $this->authModel->updatePassword($email, $hashed_password);
        if ($update_success) {
            $this->authModel->deleteToken($token);
            $_SESSION["successful"] = "Đặt lại mật khẩu thành công! Vui lòng đăng nhập bằng mật khẩu mới của bạn.";
            header("location: index.php?page=login&action=index");
            exit;
        } else {
            $_SESSION["failed"] = "Đã xảy ra lỗi khi cập nhật mật khẩu. Vui lòng thử lại.";
            header("location: index.php?page=reset-password&action=index&token=" . $token);
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