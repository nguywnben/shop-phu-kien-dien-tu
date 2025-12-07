<?php

require_once "Models/PostModel.php";

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index()
    {
        $posts = $this->postModel->getAllPosts();
        require_once "Views/admin/post-index.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=posts&action=index');
            exit;
        }
        $post = $this->postModel->getPostById($id);
        require_once "Views/admin/post-edit.php";
    }

    public function update()
    {
        if (!isset($_POST["btn_update"])) {
            header("location: admin.php?page=posts&action=index");
            exit;
        }
        $errors = [];
        $postId = $_POST["id"] ?? "";
        $maxDiscount = $_POST["max_discount"] ?? "";
        $minOrderTotal = $_POST["min_order_total"] ?? "";
        $usageLimit = $_POST["usage_limit"] ?? "";
        $startAt = $_POST["start_at"] ?? "";
        $endAt = $_POST["end_at"] ?? "";
        $status = $_POST["status"] ?? "";
        if (empty($maxDiscount)) {
            $errors["max_discount"] = "Tiền giảm không được để trống.";
        } elseif (!is_numeric($maxDiscount)) {
            $errors["max_discount"] = "Tiền giảm phải là một số.";
        } elseif ($maxDiscount < 0) {
            $errors["max_discount"] = "Tiền giảm không được là số âm.";
        }
        if (empty($minOrderTotal)) {
            $errors["min_order_total"] = "Giá trị đơn hàng không được để trống.";
        } elseif (!is_numeric($minOrderTotal)) {
            $errors["min_order_total"] = "Giá trị đơn hàng phải là một số.";
        } elseif ($minOrderTotal < 0) {
            $errors["min_order_total"] = "Giá trị đơn hàng không được là số âm.";
        }
        if (empty($usageLimit)) {
            $errors["usage_limit"] = "Số lần sử dụng không được để trống.";
        } elseif (!filter_var($usageLimit, FILTER_VALIDATE_INT)) {
            $errors["usage_limit"] = "Số lần sử dụng phải là số nguyên.";
        } elseif ($usageLimit < 1) { 
            $errors["usage_limit"] = "Số lần sử dụng phải lớn hơn 0.";
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            header("location: admin.php?page=posts&action=edit&id=" . $postId);
            exit;
        }
        $data = [
            "id" => $postId,
            "max_discount" => $maxDiscount,
            "min_order_total" => $minOrderTotal,
            "usage_limit" => $usageLimit,
            "start_at" => $startAt,
            "end_at" => $endAt,
            "status" => $status
        ];
        $result = $this->postModel->updatePost($data);
        if ($result) {
            $_SESSION["success"] = "Chỉnh sửa mã giảm giá thành công.";
            header("location: admin.php?page=posts&action=index");
            exit;
        }
    }

    public function add()
    {
        require_once "Views/admin/post-add.php";
    }
    public function delete()
    {

        $id = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
        } else {
            $id = $_GET['id'] ?? '';
        }

        if (empty($id) || !is_numeric($id)) {
            header('location: ?page=posts&action=index');
            exit;
        }

        $posts = $this->postModel->delete((int) $id);
        if ($posts) {
            $_SESSION['success'] = 'Xóa mã giảm giá thành công';
        } else {
            $_SESSION['error'] = 'Xóa mã giảm giá thất bại';
        }
        header('location: ?page=posts&action=index');
        exit;
    }
}

?>