        <?php

        $failed = $_SESSION["failed"] ?? "";
        $successful = $_SESSION["successful"] ?? "";
        unset($_SESSION["failed"], $_SESSION["successful"]);
        $appliedCoupon = $_SESSION["applied_coupon"] ?? "";

        ?>
        <section class="cart section--lg container">
            <div class="table__container">
                <?php if ($failed): ?>
                    <div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border-radius: .25rem;" role="alert">
                        <?= $failed ?>
                    </div>
                <?php endif; ?>
                <?php if ($successful): ?>
                    <div style="color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border-radius: .25rem;" role="alert">
                        <?= $successful ?>
                    </div>
                <?php endif; ?>
                <form action="index.php?page=cart&action=update" method="POST"> <table class="table">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng phụ</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($carts)): ?>
                                <?php foreach ($carts as $cart): ?>
                                <tr>
                                    <td>
                                        <img src="Assets/client/img/<?= $cart["image"] ?>" alt="" class="table__img" />
                                    </td>
                                    <td>
                                        <h3 class="table__title">
                                            <?= $cart["product_name"] ?>
                                        </h3>
                                        <?php
                                            $description = $cart["description"];
                                            $maxLength = 70;
                                            if (mb_strlen($description, 'UTF-8') > $maxLength) {
                                                $description = mb_substr($description, 0, $maxLength, 'UTF-8') . "...";
                                            }
                                        ?>
                                        <p class="table__description">
                                            <?= $description ?>
                                        </p>
                                    </td>
                                    <td>
                                        <span class="table__price"><?= number_format($cart["price"]) ?> đ</span>
                                    </td>
                                    <td>
                                        <input type="number" class="quantity" name="quantities[<?= $cart["product_id"] ?>]" value="<?= $cart["quantity"] ?>" min="1" /></td>
                                    <td>
                                        <span class="subtotal"><?= number_format($cart["price"] * $cart["quantity"]) ?> đ</span>
                                    </td>
                                    <td><a href="index.php?page=cart&action=remove&product_id=<?= $cart["product_id"] ?>"><i class="fi fi-rs-trash table__trash"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="no-items">Giỏ hàng của bạn đang trống.</td> </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="cart__actions">
                    <button type="submit" class="btn flex btn__md" style="cursor: pointer;"> <i class="fi-rs-shuffle"></i> Cập nhật giỏ hàng
                    </button>
                    <a href="index.php?page=shop" class="btn flex btn__md">
                        <i class="fi-rs-shopping-bag"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </form> <div class="divider">
                <i class="fi fi-rs-fingerprint"></i>
            </div>

            <div class="cart__group grid">
                <div>
                    <div class="cart__coupon">
                        <h3 class="section__title">Áp dụng phiếu giảm giá</h3>
                        <form action="index.php?page=cart&action=coupon" method="post" class="coupon__form form grid">
                            <div class="form__group grid">
                                <input type="text" class="form__input" name="coupon" placeholder="Nhập mã giảm giá của bạn" value="<?= $appliedCoupon['code'] ?? '' ?>" />
                                <div class="form__btn">
                                    <a href="">
                                        <button class="btn flex btn--sm" type="submit" name="coupon_submit" style="cursor: pointer;">
                                            <i class="fi-rs-label"></i> Áp dụng
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="cart__total">
                    <h3 class="section__title">Tổng giỏ hàng</h3>
                    <table class="cart__total-table">
                        <tr>
                            <td><span class="cart__total-title">Tổng phụ</span></td>
                            <td><span class="cart__total-price">
                                <?php
                                    $totalPrice = 0;
                                    if (!empty($carts)) {
                                        foreach ($carts as $cart) {
                                            $totalPrice += ($cart["price"] * $cart["quantity"]);
                                        }
                                    }
                                    echo number_format($totalPrice) . " đ";
                                ?>
                            </span></td>
                        </tr>
                        <tr>
                            <td><span class="cart__total-title">Phiếu giảm giá</span></td>
                            <td><span class="cart__total-price">
                                <?php
                                    $discountAmount = 0;
                                    if ($appliedCoupon && $totalPrice > 0) {
                                        $discountPercentage = $appliedCoupon['discount_percentage'];
                                        $discountAmount = ($totalPrice * $discountPercentage) / 100;
                                    }
                                    echo number_format($discountAmount) . " đ";
                                ?>
                            </span></td>
                        </tr>
                        <tr>
                            <td><span class="cart__total-title">Tổng cộng</span></td>
                            <td><span class="cart__total-price">
                                <?php
                                    $finalTotal = $totalPrice - $discountAmount;
                                    echo number_format($finalTotal) . " đ";
                                ?>
                            </span></td>
                        </tr>
                    </table>
                        <?php if (!empty($carts)): ?> 
                            <a href="index.php?page=checkout&action=index" class="btn flex btn--md">
                                <i class="fi fi-rs-box-alt"></i> Tiến hành thanh toán
                            </a>
                        <?php else: ?>
                            <span class="btn flex btn--md btn--disabled" style="opacity: 0.6; cursor: not-allowed;">
                                <i class="fi fi-rs-box-alt"></i> Giỏ hàng trống
                            </span>
                        <?php endif; ?>
                </div>
            </div>
        </section>