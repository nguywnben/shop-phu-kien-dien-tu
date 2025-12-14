<?php

require_once "Models/CouponModel.php";

class CouponController
{
    private $couponModel;

    public function __construct()
    {
        $this->couponModel = new CouponModel();
    }

    public function index()
    {
        $limit = 10;
        $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $limit;

        $coupons = $this->couponModel->getAllCouponsPaginated($limit, $offset);
        $totalCoupons = $this->couponModel->countCoupons();
        $totalPages = ceil($totalCoupons / $limit);

        $pagination = [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'totalCoupons' => $totalCoupons,
        ];

        require_once "Views/admin/coupon-index.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=coupons&action=index');
            exit;
        }
        $coupon = $this->couponModel->getCouponById($id);
        if (!$coupon) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }
        require_once "Views/admin/coupon-edit.php";
    }

    public function update()
    {
        if (!isset($_POST["btn_update"])) {
            header("location: admin.php?page=coupons&action=index");
            exit;
        }
        $errors = [];
        $couponId = $_POST["id"] ?? "";
        $maxDiscount = $_POST["max_discount"] ?? "";
        $minOrderTotal = $_POST["min_order_total"] ?? "";
        $usageLimit = $_POST["usage_limit"] ?? "";
        $startAt = $_POST["start_at"] ?? "";
        $endAt = $_POST["end_at"] ?? "";
        $status = $_POST["status"] ?? "";
        if (empty($maxDiscount)) {
            $errors["max_discount"] = "Phần trăm giảm giá không được để trống.";
        } elseif (!is_numeric($maxDiscount)) {
            $errors["max_discount"] = "Phần trăm giảm giá phải là một số.";
        } elseif ($maxDiscount < 0 || $maxDiscount > 100) {
            $errors["max_discount"] = "Phần trăm giảm giá phải từ 0 đến 100.";
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
            header("location: admin.php?page=coupons&action=edit&id=" . $couponId);
            exit;
        }
        $data = [
            "id" => $couponId,
            "max_discount" => $maxDiscount,
            "min_order_total" => $minOrderTotal,
            "usage_limit" => $usageLimit,
            "start_at" => $startAt,
            "end_at" => $endAt,
            "status" => $status
        ];
        $result = $this->couponModel->updateCoupon($data);
        if ($result) {
            $_SESSION["success"] = "Chỉnh sửa mã giảm giá thành công.";
            header("location: admin.php?page=coupons&action=index");
            exit;
        }
    }

    public function add()
    {
        require_once "Views/admin/coupon-add.php";
    }

    public function store()
    {
        if (!isset($_POST["create"])) {
            header("location: admin.php?page=coupons&action=index");
            exit;
        }

        $errors = [];
        $code = $_POST["code"] ?? "";
        $maxDiscount = $_POST["max_discount"] ?? "";
        $minOrderTotal = $_POST["min_order_total"] ?? "";
        $usageLimit = $_POST["usage_limit"] ?? "";
        $startAt = $_POST["start_at"] ?? "";
        $endAt = $_POST["end_at"] ?? "";
        $status = $_POST["status"] ?? "1";

        // Validation
        if (empty($code)) {
            $errors["code"] = "Mã giảm giá không được để trống.";
        } elseif (strlen($code) > 255) {
            $errors["code"] = "Mã giảm giá không được vượt quá 255 ký tự.";
        }

        if (empty($maxDiscount)) {
            $errors["max_discount"] = "Phần trăm giảm giá không được để trống.";
        } elseif (!is_numeric($maxDiscount)) {
            $errors["max_discount"] = "Phần trăm giảm giá phải là một số.";
        } elseif ($maxDiscount < 0 || $maxDiscount > 100) {
            $errors["max_discount"] = "Phần trăm giảm giá phải từ 0 đến 100.";
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

        if (empty($status)) {
            $errors["status"] = "Trạng thái không được để trống.";
        }

        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["code_old"] = $code;
            $_SESSION["max_discount_old"] = $maxDiscount;
            $_SESSION["min_order_total_old"] = $minOrderTotal;
            $_SESSION["usage_limit_old"] = $usageLimit;
            $_SESSION["start_at_old"] = $startAt;
            $_SESSION["end_at_old"] = $endAt;
            $_SESSION["status_old"] = $status;
            header("location: admin.php?page=coupons&action=add");
            exit;
        }

        $result = $this->couponModel->createCoupon($code, $maxDiscount, $minOrderTotal, $usageLimit, $startAt, $endAt, $status);
        if ($result) {
            $_SESSION["success"] = "Thêm mã giảm giá thành công.";
            header("location: admin.php?page=coupons&action=index");
            exit;
        } else {
            $_SESSION["error"] = "Thêm mã giảm giá thất bại. Vui lòng thử lại.";
            $_SESSION["code_old"] = $code;
            $_SESSION["max_discount_old"] = $maxDiscount;
            $_SESSION["min_order_total_old"] = $minOrderTotal;
            $_SESSION["usage_limit_old"] = $usageLimit;
            $_SESSION["start_at_old"] = $startAt;
            $_SESSION["end_at_old"] = $endAt;
            $_SESSION["status_old"] = $status;
            header("location: admin.php?page=coupons&action=add");
            exit;
        }
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
            header('location: ?page=coupons&action=index');
            exit;
        }

        $coupons = $this->couponModel->delete((int) $id);
        if ($coupons) {
            $_SESSION['success'] = 'Xóa mã giảm giá thành công';
        } else {
            $_SESSION['error'] = 'Xóa mã giảm giá thất bại';
        }
        header('location: ?page=coupons&action=index');
        exit;
    }

}

?>