<?php

require_once "Models/UserModel.php";

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        require_once "Views/admin/users.php";
    }

    public function edit()
    {
        $userId = $_GET["id"] ?? "";
        if ($userId == "") {
            header("location: admin.php?page=users&action=index");
            exit;
        }
        $user = $this->userModel->getUserById($userId);
        if (!$user) {
            header("location: admin.php?page=users&action=index");
            exit;
        }
        require_once "Views/admin/user-edit.php";
    }

    public function update() {
        if (!isset($_POST["edit"])) {
            header("location: admin.php?page=users&action=index");
            exit;
        }
        $errors = [];
        $userId = $_POST["id"] ?? "";
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $role = $_POST["role"] ?? 0;
        $status = $_POST["status"] ?? 0;
        $oldUser = $this->userModel->getUserById($userId);
        $avatarName = $oldUser['avatar'] ?? '';
        if (empty($name)) {
            $errors["name"] = "Họ và tên không được để trống.";
        }
        if (empty($email)) {
            $errors["email"] = "Địa chỉ email không được để trống.";
        }
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Địa chỉ email không hợp lệ.";
        }
        if (empty($phone)) {
            $errors["phone"] = "Số điện thoại không được để trống.";
        }
        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
            $targetDir = "Assets/client/img/"; 
            $fileName = basename($_FILES["avatar"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = time() . "_" . $userId . "." . $fileExtension;
            $targetFilePath = $targetDir . $newFileName;
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                if ($oldUser && !empty($oldUser['avatar']) && file_exists($targetDir . $oldUser['avatar'])) {
                    unlink($targetDir . $oldUser['avatar']);
                }
                $avatarName = $newFileName;
            } else {
                $errors["avatar"] = "Lỗi khi tải lên ảnh.";
            }
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            header("location: admin.php?page=users&action=edit&id=" . $userId);
            exit;
        }
        $data = [
            "id" => $userId,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "role" => (int) $role,
            "status" => (int) $status
        ];
        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
            $data["avatar"] = $avatarName;
        }
        $result = $this->userModel->updateUser($data);
        if ($result) {
            $_SESSION["success"] = "Chỉnh sửa thành viên thành công.";
            header("location: admin.php?page=users&action=index");
            exit;
        } else {
            $_SESSION["errors"] = ["update_error" => "Lỗi hệ thống! Không thể chỉnh sửa thành viên."];
            header("location: admin.php?page=users&action=edit&id=" . $userId);
            exit;
        }
    }
}

?>