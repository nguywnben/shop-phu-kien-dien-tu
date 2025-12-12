<?php
require_once "Models/UserModel.php";
class ProfileController
{
    public function index()
    {
        $userId = isset($_SESSION['login']['id']) ? (int) $_SESSION['login']['id'] : 0;
        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);
        require "Views/admin/profile.php";
    }

    public function update()
    {
        $userId = isset($_SESSION['login']['id']) ? (int) $_SESSION['login']['id'] : 0;
        $userModel = new UserModel();
        $avatarFile = $_FILES['avatar'] ?? null;

        if ($avatarFile && $avatarFile['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($avatarFile['name'], PATHINFO_EXTENSION);
            $newName = 'user_' . $userId . '_' . time() . '.' . $ext;
            $uploadDir = 'Assets/admin/images/user/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $targetFile = $uploadDir . $newName;
            if (move_uploaded_file($avatarFile['tmp_name'], $targetFile)) {
                $avatarPath = $targetFile;
                // Lấy lại thông tin user hiện tại để không truyền null vào các trường bắt buộc
                $currentUser = $userModel->getUserById($userId);
                $userModel->updateUserProfileFull(
                    $userId,
                    $currentUser['name'] ?? '',
                    $currentUser['email'] ?? '',
                    $currentUser['phone'] ?? '',
                    $avatarPath
                );
                $_SESSION['success'] = 'Cập nhật ảnh đại diện thành công!';
                $_SESSION['login']['avatar'] = $avatarPath;
            } else {
                $_SESSION['error'] = 'Upload ảnh đại diện thất bại!';
            }
            header('Location: ?page=profile&action=index');
            exit;
        }

        // Xử lý cập nhật thông tin cá nhân (không phải upload avatar)
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        // $about = trim($_POST['about'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $role = $userModel->getUserById($userId)['role'];

        if ($name === '' || $email === '') {
            $_SESSION['error'] = 'Tên và email không được để trống';
        } else {
            $update = $userModel->updateUserProfileFull($userId, $name, $email, $phone, null);
            if ($update) {
                $_SESSION['success'] = 'Cập nhật thành công!';
                $_SESSION['login']['name'] = $name;
                $_SESSION['login']['email'] = $email;
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại!';
            }
        }
        header('Location: ?page=profile&action=index');
        exit;
    }
}
