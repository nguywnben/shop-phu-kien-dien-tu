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
}

?>