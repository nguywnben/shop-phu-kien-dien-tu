<?php

require_once "Models/UserModel.php";
require_once "Models/CartModel.php";
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AccountController
{
    private $userModel;
    private $cartModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cartModel = new CartModel();
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

    public function cart()
    {
        if (isset($_SESSION["login"])) {
            $userId = $_SESSION["login"]["id"] ?? "";
            $carts = $this->cartModel->cart($userId);
            include "Views/Client/cart.php";
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function addCart()
    {
        $url = $_SERVER["HTTP_REFERER"] ?? "index.php";
        $productId = $_GET["product_id"] ?? "";
        $quantity = max(1, (int)($_GET["quantity"] ?? 1)); 
        if (isset($_SESSION["login"])) {
            $userId = $_SESSION["login"]["id"] ?? "";
            if ($userId && $productId && $quantity > 0) {
                $result = $this->cartModel->addCart($userId, $productId, $quantity); 
                if ($result) {
                    $_SESSION["successful"] = "Đã thêm sản phẩm vào giỏ hàng.";
                    header("location: " . $url);
                    exit;
                } else {
                    $_SESSION["failed"] = "Thêm sản phẩm vào giỏ hàng thất bại.";
                    header("location: " . $url);
                    exit;
                }
            } else {
                $_SESSION["failed"] = "Thông tin sản phẩm hoặc số lượng không hợp lệ.";
                header("location: " . $url);
                exit;
            }
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: " . $url);
            exit;
        }
    }

    public function updateCart()
    {
        if (isset($_SESSION["login"])) {
            $userId = $_SESSION["login"]["id"] ?? "";
            if (isset($_POST["quantities"])) {
                $allUpdated = true;
                foreach ($_POST["quantities"] as $productId => $quantity) {
                    $quantity = max(1, (int)$quantity);
                    $result = $this->cartModel->updateCart($userId, $productId, $quantity);
                    if (!$result) {
                        $allUpdated = false;
                    }
                }
                if ($allUpdated) {
                    $_SESSION["successful"] = "Giỏ hàng đã được cập nhật.";
                } else {
                    $_SESSION["failed"] = "Cập nhật giỏ hàng thất bại hoặc có sản phẩm không tồn tại."; 
                }
            } else {
                $_SESSION["failed"] = "Không có sản phẩm nào để cập nhật.";
            }
            header("location: index.php?page=cart&action=index");
            exit;
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function removeCart()
    {
        $url = $_SERVER["HTTP_REFERER"] ?? "index.php?page=cart&action=index";
        $productId = $_GET["product_id"] ?? "";
        if (isset($_SESSION["login"])) {
            $userId = $_SESSION["login"]["id"] ?? ""; 
            if ($userId && $productId) {
                $result = $this->cartModel->removeCart($userId, $productId);
                
                if ($result) {
                    $_SESSION["successful"] = "Đã xóa sản phẩm khỏi giỏ hàng.";
                } else {
                    $_SESSION["failed"] = "Xóa sản phẩm khỏi giỏ hàng thất bại. Vui lòng thử lại.";
                }
            } else {
                $_SESSION["failed"] = "Thiếu thông tin sản phẩm hoặc người dùng.";
            }
            header("location: " . $url);
            exit;
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function coupon()
    {
        if (!isset($_SESSION["login"])) {
            $_SESSION["failed"] = "Bạn chưa đăng nhập để áp dụng mã giảm giá.";
            header("location: index.php?page=login&action=index");
            exit;
        }
        $couponCode = $_POST["coupon"] ?? "";
        $url = $_SERVER["HTTP_REFERER"] ?? "index.php?page=cart&action=index";
        $userId = $_SESSION["login"]["id"] ?? "";
        if (empty($couponCode)) {
            $_SESSION["failed"] = "Vui lòng nhập mã giảm giá.";
            header("location: " . $url);
            exit;
        }
        $carts = $this->cartModel->cart($userId);
        $totalPrice = 0;
        if (!empty($carts)) {
            foreach ($carts as $cart) {
                $totalPrice += ($cart["price"] * $cart["quantity"]);
            }
        }
        if ($totalPrice == 0) {
            $_SESSION["failed"] = "Giỏ hàng của bạn đang trống, không thể áp dụng mã giảm giá.";
            header("location: " . $url);
            exit;
        }
        $coupon = $this->cartModel->getCouponByCode($couponCode);
        
        if ($coupon) {
            $minOrderTotal = (float)($coupon["min_order_total"] ?? 0);
            if ($totalPrice < $minOrderTotal) {
                $_SESSION["failed"] = "Mã giảm giá yêu cầu tổng đơn hàng tối thiểu là " . number_format($minOrderTotal) . " đ.";
                unset($_SESSION["applied_coupon"]);
            } else {
                $_SESSION["applied_coupon"] = [
                    "code" => $coupon["code"],
                    "discount_percentage" => $coupon["discount_value"]
                ];
                $_SESSION["successful"] = "Mã giảm giá đã được áp dụng thành công.";
            }
        } else {
            $_SESSION["failed"] = "Mã giảm giá không hợp lệ, đã hết hạn, hoặc đã hết lượt sử dụng.";
            unset($_SESSION["applied_coupon"]);
        }
        header("location: " . $url);
        exit;
    }

    public function checkout()
    {
        $userId = $_SESSION["login"]["id"] ?? "";
        if ($userId) {
            $products = $this->cartModel->cart($userId);
            if (empty($products)) {
                $_SESSION["failed"] = "Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm.";
                header("location: index.php?page=cart&action=index");
                exit;
            }
            include "Views/Client/checkout.php";
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function handleCheckout()
    {
        $userId = $_SESSION["login"]["id"] ?? "";
        $fullName = $_POST["full_name"] ?? "";
        $provinceName = $_POST["province_name"] ?? "";
        $districtName = $_POST["district_name"] ?? "";
        $wardName = $_POST["ward_name"] ?? "";
        $addressLine = $_POST["address_line"] ?? "";
        $phoneNumber = $_POST["phone_number"] ?? "";
        $email = $_POST["email"] ?? "";
        $orderNotes = $_POST["order_notes"] ?? "";
        $paymentMethod = $_POST["payment_method"] ?? "";
        if (empty($fullName) || empty($provinceName) || empty($districtName) || empty($wardName) || empty($addressLine) || empty($phoneNumber) || empty($email) || empty($paymentMethod)) {
            $_SESSION["failed"] = "Vui lòng điền đầy đủ thông tin thanh toán.";
            header("location: index.php?page=checkout&action=index");
            exit;
        }
        if ($userId) {
            $appliedCoupon = $_SESSION["applied_coupon"] ?? null;
            $cartItems = $this->cartModel->cart($userId); 
            
            if (empty($cartItems)) {
                $_SESSION["failed"] = "Giỏ hàng trống, không thể thanh toán.";
                header("location: index.php?page=cart&action=index");
                exit;
            }
            $subtotal = 0;
            foreach ($cartItems as $product) {
                $subtotal += ($product["price"] * $product["quantity"]);
            }
            $discountAmount = 0;
            if ($appliedCoupon && $subtotal > 0) {
                $discountPercentage = $appliedCoupon['discount_percentage'];
                $discountAmount = ($subtotal * $discountPercentage) / 100;
            }
            $grandTotal = $subtotal - $discountAmount;
            $orderData = [
                "full_name" => $fullName,
                "phone_number" => $phoneNumber,
                "email" => $email,
                "province_name" => $provinceName,
                "district_name" => $districtName,
                "ward_name" => $wardName,
                "address_line" => $addressLine,
                "order_notes" => $orderNotes,
                "payment_method" => $paymentMethod,
                "subtotal" => $subtotal,
                "discount_total" => $discountAmount,
                "grand_total" => $grandTotal
            ];
            $result = $this->cartModel->handleCheckout($userId, $orderData, $cartItems);
            if ($result) {
                $orderId = $result;
                unset($_SESSION["applied_coupon"]);
                $_SESSION["successful"] = "Đã đặt hàng thành công.";
                $this->sendOrderConfirmationEmail($orderId);
                header("location: index.php?page=account&id=1#orders");
                exit;
            } else {
                $_SESSION["failed"] = "Xử lý thanh toán thất bại. Vui lòng thử lại.";
                header("location: index.php?page=checkout&action=index");
                exit;
            }
        } else {
            $_SESSION["failed"] = "Bạn chưa đăng nhập.";
            header("location: index.php?page=login&action=index");
            exit;
        }
    }

    public function sendOrderConfirmationEmail($orderId)
    {
        $order = $this->cartModel->getOrderDetails($orderId);
        if (!$order) {
            return false;
        }
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8'; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nben65206@gmail.com';
            $mail->Password = 'vxnl abzn xzdy mlpy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587;
            $mail->setFrom('no-reply@gearzone.com', 'GearZone');
            $mail->addAddress($order["email"], $order["recipient_name"]);
            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận Đơn hàng Thành công #' . $orderId;
            $mail->Body = $this->buildEmailContent($order);
            $mail->AltBody = 'Đơn hàng của bạn đã được xác nhận. Vui lòng xem email HTML để biết chi tiết.';
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Lỗi gửi email xác nhận đơn hàng #{$orderId}. Lỗi PHPMailer: {$mail->ErrorInfo}");
            return false;
        }
    }

    private function buildEmailContent($order)
    {
        $paymentMethodMapping = [
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'cash_on_delivery' => 'Thanh toán khi nhận hàng (COD)',
        ];
        $friendlyPaymentMethod = $paymentMethodMapping[$order['payment_method']] ?? $order['payment_method'];
        $itemsHtml = '';
        foreach ($order['items'] as $item) {
            $lineTotal = number_format($item['line_total'], 0, ',', '.');
            $unitPrice = number_format($item['unit_price'], 0, ',', '.');
            $itemsHtml .= "
                <tr>
                    <td style='border: 1px solid #ddd; padding: 8px;'>{$item['product_name']}</td>
                    <td style='border: 1px solid #ddd; padding: 8px; text-align: center;'>{$item['qty']}</td>
                    <td style='border: 1px solid #ddd; padding: 8px; text-align: right;'>{$unitPrice} đ</td>
                    <td style='border: 1px solid #ddd; padding: 8px; text-align: right;'>{$lineTotal} đ</td>
                </tr>
            ";
        }
        $subtotal = number_format($order['subtotal'], 0, ',', '.');
        $discountTotal = number_format($order['discount_total'], 0, ',', '.');
        $grandTotal = number_format($order['grand_total'], 0, ',', '.');
        $shippingFee = number_format($order['shipping_fee'], 0, ',', '.');
        $content = "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Xác nhận Đơn hàng #{$order['id']}</title>
                <meta charset='utf-8'>
            </head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd;'>
                <div style='text-align: center; margin-bottom: 20px;'>
                    <h1 style='color: #4CAF50;'>🎉 Đơn hàng của bạn đã được đặt thành công! 🎉</h1>
                </div>
                <p>Kính gửi <strong>{$order['recipient_name']}</strong>,</p>
                <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Chúng tôi đã nhận được đơn hàng của bạn với mã <strong>#{$order['id']}</strong> và sẽ tiến hành xử lý sớm nhất.</p>
                <h2 style='border-bottom: 2px solid #eee; padding-bottom: 5px;'>Chi tiết Đơn hàng #{$order['id']}</h2>
                <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                    <thead>
                        <tr>
                            <th style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;'>Sản phẩm</th>
                            <th style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: center;'>SL</th>
                            <th style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: right;'>Đơn giá</th>
                            <th style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: right;'>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$itemsHtml}
                    </tbody>
                </table>
                <div style='margin-bottom: 20px; text-align: right;'>
                    <p style='margin: 0;'><strong>Tổng tiền hàng:</strong> <strong style='color: #333;'>{$subtotal} đ</strong></p>
                    <p style='margin: 0;'><strong>Giảm giá:</strong> <strong style='color: #E91E63;'>-{$discountTotal} đ</strong></p>
                    <p style='margin: 0;'><strong>Phí vận chuyển:</strong> <strong style='color: #333;'>{$shippingFee} đ</strong></p>
                    <p style='margin: 10px 0; padding-top: 5px; border-top: 1px dashed #ddd;'><strong>TỔNG CỘNG:</strong> <strong style='color: #4CAF50; font-size: 1.2em;'>{$grandTotal} đ</strong></p>
                </div>
                <h2 style='border-bottom: 2px solid #eee; padding-bottom: 5px;'>Thông tin Vận chuyển</h2>
                <p>
                    <strong>Người nhận:</strong> {$order['recipient_name']} <br>
                    <strong>Điện thoại:</strong> {$order['phone']} <br>
                    <strong>Email:</strong> {$order['email']} <br>
                    <strong>Địa chỉ:</strong> {$order['address_line']}, {$order['ward']}, {$order['district']}, {$order['province']} <br>
                    <strong>Phương thức thanh toán:</strong> {$friendlyPaymentMethod} </p>
                <p style='text-align: center; margin-top: 30px; font-size: 0.9em; color: #888;'>
                    Bạn có thể theo dõi đơn hàng tại tài khoản của mình. <br>
                    Xin chân thành cảm ơn.
                </p>
                
            </body>
            </html>
        ";
        return $content;
    }
}