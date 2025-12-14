<?php

require_once "Database.php";

class CartModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function cart($userId) {
        $stmt = $this->conn->prepare("
            SELECT 
                ci.id AS cart_item_id,
                ci.qty AS quantity,
                ci.product_id,
                p.name AS product_name,
                p.price,
                p.description,
                pi1.url AS image
            FROM 
                cart_items ci
            JOIN 
                products p ON ci.product_id = p.id
            LEFT JOIN 
                product_images pi1 ON p.id = pi1.product_id AND pi1.sort_order = 1
            WHERE 
                ci.user_id = :user_id
        ");
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCart($userId, $productId, $quantity = 1)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT 
                    qty 
                FROM 
                    cart_items 
                WHERE 
                    user_id = :user_id 
                    AND product_id = :product_id
            ");
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
            $stmt->execute();
            $existingQuantity = $stmt->fetchColumn();
            if ($existingQuantity) {
                $newQuantity = $existingQuantity + $quantity;
                $stmt = $this->conn->prepare("
                    UPDATE 
                        cart_items 
                    SET 
                        qty = :qty, 
                        updated_at = NOW() 
                    WHERE 
                        user_id = :user_id 
                        AND product_id = :product_id
                ");
                $stmt->bindParam(":qty", $newQuantity, PDO::PARAM_INT);
                $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
                $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                $stmt = $this->conn->prepare("
                    INSERT INTO 
                        cart_items (user_id, product_id, qty, created_at, updated_at) 
                    VALUES 
                        (:user_id, :product_id, :qty, NOW(), NOW())
                ");
                $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
                $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
                $stmt->bindParam(":qty", $quantity, PDO::PARAM_INT);
                return $stmt->execute();
            }
        } catch (PDOException $e) {
            $errorMessage = date("Y-m-d H:i:s") . " - Lỗi khi người dùng thêm sản phẩm vào giỏ hàng: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . "/../Logs/Error.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function getTotalUniqueProductsInCart($userId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(id) FROM cart_items WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function updateCart($userId, $productId, $quantity)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT 
                    COUNT(*) 
                FROM 
                    cart_items 
                WHERE 
                    user_id = :user_id 
                    AND product_id = :product_id
            ");
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
            $stmt->execute();
            $exists = $stmt->fetchColumn();
            if ($exists) {
                $stmt = $this->conn->prepare("
                    UPDATE 
                        cart_items 
                    SET 
                        qty = :quantity  -- Trường số lượng trong DB là 'qty'
                    WHERE 
                        user_id = :user_id 
                        AND product_id = :product_id
                ");
                $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
                $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
                $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $errorMessage = date("Y-m-d H:i:s") . " - Lỗi khi cập nhật số lượng sản phẩm trong giỏ hàng: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . "/../Logs/Error.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function removeCart($userId, $productId)
    {
        try {
            $stmt = $this->conn->prepare("
                DELETE FROM 
                    cart_items 
                WHERE 
                    user_id = :user_id 
                    AND product_id = :product_id
            ");
            $data = [
                "user_id" => $userId,
                "product_id" => $productId
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            $errorMessage = date("Y-m-d H:i:s") . " - Lỗi khi người dùng xóa sản phẩm trong giỏ hàng: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . "/../Logs/Error.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function getCouponByCode($couponCode)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                code,                 
                max_discount AS discount_value,
                min_order_total
            FROM 
                coupons 
            WHERE 
                code = :coupon_code 
                AND start_at <= NOW()
                AND end_at >= NOW()
                AND status = 1
                AND usage_limit > used_count
        ");
        $stmt->bindParam(":coupon_code", $couponCode, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function handleCheckout($userId, $orderData, $cartItems) 
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                INSERT INTO orders (
                    user_id, status, subtotal, discount_total, shipping_fee, grand_total, 
                    payment_status, shipping_status, note, recipient_name, phone, 
                    province, district, ward, address_line, email, created_at,
                    payment_method
                )
                VALUES (
                    :user_id, :status, :subtotal, :discount_total, :shipping_fee, :grand_total, 
                    :payment_status, :shipping_status, :note, :recipient_name, :phone, 
                    :province, :district, :ward, :address_line, :email, :created_at,
                    :payment_method
                )
            ");
            $createdAt = date("Y-m-d H:i:s");
            $defaultStatus = 1; 
            $shippingFee = 0.00;
            $defaultPaymentStatus = 0;
            $defaultShippingStatus = 0;
            $data = [
                ":user_id" => $userId,
                ":status" => $defaultStatus,
                ":subtotal" => $orderData["subtotal"],
                ":discount_total" => $orderData["discount_total"],
                ":shipping_fee" => $shippingFee,
                ":grand_total" => $orderData["grand_total"],
                ":payment_status" => $defaultPaymentStatus,
                ":shipping_status" => $defaultShippingStatus,
                ":note" => $orderData["order_notes"],
                ":recipient_name" => $orderData["full_name"],
                ":phone" => $orderData["phone_number"],
                ":province" => $orderData["province_name"],
                ":district" => $orderData["district_name"],
                ":ward" => $orderData["ward_name"],
                ":address_line" => $orderData["address_line"],
                ":email" => $orderData["email"],
                ":created_at" => $createdAt,
                ":payment_method" => $orderData["payment_method"]
            ];
            $stmt->execute($data);
            $orderId = $this->conn->lastInsertId();
            $stmt = $this->conn->prepare("
                INSERT INTO order_items (
                    order_id, product_id, sku_snapshot, unit_price, qty, line_total, created_at
                )
                VALUES (
                    :order_id, :product_id, :sku_snapshot, :unit_price, :qty, :line_total, :created_at
                )
            ");
            foreach ($cartItems as $item) {
                $lineTotal = $item["price"] * $item["quantity"]; 
                $itemData = [
                    ":order_id" => $orderId,
                    ":product_id" => $item["product_id"],
                    ":sku_snapshot" => "",
                    ":unit_price" => $item["price"], 
                    ":qty" => $item["quantity"], 
                    ":line_total" => $lineTotal,
                    ":created_at" => $createdAt
                ];
                $stmt->execute($itemData);
            }
            $this->clearCartItems($userId); 
            $this->conn->commit();
            return $orderId; 
        } catch (PDOException $e) {
            $this->conn->rollBack();
            $errorMessage = date("Y-m-d H:i:s") . " - Lỗi khi xử lý thanh toán: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . "/../Logs/Error.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function getOrderDetails($orderId)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                o.*
            FROM 
                orders o
            WHERE 
                o.id = :order_id
        ");
        $stmt->bindParam(":order_id", $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$order) {
            return false;
        }
        $stmtItems = $this->conn->prepare("
            SELECT 
                oi.product_id,
                oi.unit_price,
                oi.qty,
                oi.line_total,
                p.name as product_name
            FROM 
                order_items oi
            JOIN
                products p ON oi.product_id = p.id
            WHERE 
                oi.order_id = :order_id
        ");
        $stmtItems->bindParam(":order_id", $orderId, PDO::PARAM_INT);
        $stmtItems->execute();
        $orderItems = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
        $order['items'] = $orderItems;
        return $order;
    }

    public function clearCartItems($userId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM cart_items WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = date("Y-m-d H:i:s") . " - Lỗi khi xóa các mặt hàng trong giỏ hàng: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . "/../Logs/Error.log", $errorMessage, FILE_APPEND);
            return false;
        }
    }
}

?>