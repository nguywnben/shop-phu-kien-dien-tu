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
        $coupons = $this->couponModel->getAllCoupons();
        require_once "Views/admin/coupon-index.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=coupons&action=index');
            exit;
        }
        $coupon = $this->couponModel->getCouponById((int) $id);
        require_once "Views/admin/coupon-edit.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
            
            $code = trim($_POST['code'] ?? '');
            $max_discount = trim($_POST['max_discount'] ?? '');
            $min_order_total = trim($_POST['min_order_total'] ?? '');
            $usage_limit = trim($_POST['usage_limit'] ?? '');
            $start_at = trim($_POST['start_at'] ?? '');
            $end_at = trim($_POST['end_at'] ?? '');
            $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';

            $_SESSION['code_error'] = '';
            $_SESSION['max_discount_error'] = '';
            $_SESSION['min_order_total_error'] = '';
            $_SESSION['usage_limit_error'] = '';
            $_SESSION['start_at_error'] = '';
            $_SESSION['end_at_error'] = '';
            $_SESSION['status_error'] = '';
            
            if (empty($code)) {
                $_SESSION['code_error'] = 'Vui lòng nhập mã giảm giá';
            }
            if (empty($max_discount)) {
                $_SESSION['max_discount_error'] = 'Vui lòng nhập số tiền giảm tối đa';
            }
            if ($status === '') {
                $_SESSION['status_error'] = 'Vui lòng chọn trạng thái';
            }

            $_SESSION['code_old'] = $code;
            $_SESSION['max_discount_old'] = $max_discount;
            $_SESSION['min_order_total_old'] = $min_order_total;
            $_SESSION['usage_limit_old'] = $usage_limit;
            $_SESSION['start_at_old'] = $start_at;
            $_SESSION['end_at_old'] = $end_at;
            $_SESSION['status_old'] = $status;


            $has_error = false;
            if (!empty($_SESSION['code_error']) || !empty($_SESSION['max_discount_error']) || !empty($_SESSION['status_error']) ) {
                $has_error = true;
            }

            if ($has_error) {
                header('location: ?page=coupons&action=edit&id=' . $id);
                exit;
            }

            if ($this->couponModel->existsByCode($code, $id)) {
                $_SESSION['code_error'] = 'Mã giảm giá đã tồn tại';
                $_SESSION['code_old'] = $code;
                header('location: ?page=coupons&action=edit&id=' . $id);
                exit;
            }

            $result = $this->couponModel->updateCoupon(
                $id, 
                $code, 
                $max_discount, 
                $min_order_total, 
                $usage_limit,
                $start_at,
                $end_at, 
                $status
            );

            if ($result) {
                unset(
                    $_SESSION['code_error'], $_SESSION['max_discount_error'], $_SESSION['min_order_total_error'],
                    $_SESSION['usage_limit_error'], $_SESSION['start_at_error'], $_SESSION['end_at_error'], $_SESSION['status_error'],
                    $_SESSION['code_old'], $_SESSION['max_discount_old'], $_SESSION['min_order_total_old'],
                    $_SESSION['usage_limit_old'], $_SESSION['start_at_old'], $_SESSION['end_at_old'], $_SESSION['status_old']
                );
                $_SESSION['success'] = 'Cập nhật mã giảm giá thành công';
                header('location: ?page=coupons&action=index');
                exit;
            } else {
                $_SESSION['error'] = 'Cập nhật mã giảm giá thất bại';
                header('location: ?page=coupons&action=edit&id=' . $id);
                exit;
            }
        }
    }
    public function add()
    {
        require_once "Views/admin/coupon-add.php";
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