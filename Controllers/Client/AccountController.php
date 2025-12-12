<?php
require_once "Models/UserModel.php";

class AccountController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?page=login&action=index");
            exit();
        }

        $userId = $_SESSION['login']['id'] ?? 0;
        $user = $this->userModel->getById($userId);

        require_once "Views/client/accounts.php";
    }

    public function update()
    {
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?page=login&action=index");
            exit();
        }

        $userId = $_SESSION['login']['id'] ?? 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = 'Tên không được để trống.';
                header("Location: index.php?page=account");
                exit();
            }

            $result = $this->userModel->updateProfile($userId, $name, $phone);
            if ($result) {
                $_SESSION['login']['name'] = $name;
                $_SESSION['login']['phone'] = $phone;
                $_SESSION['success'] = 'Cập nhật hồ sơ thành công!';
                header("Location: index.php?page=account");
                exit();
            } else {
                $_SESSION['error'] = 'Cập nhật hồ sơ thất bại. Vui lòng thử lại.';
                header("Location: index.php?page=account");
                exit();
            }
        }
    }
}

