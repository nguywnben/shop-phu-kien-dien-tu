        <?php

        $appliedCoupon = $_SESSION["applied_coupon"] ?? "";

        ?>
        <section class="checkout section--lg">
            <div class="checkout__container container grid">
                <div class="checkout__group">
                    <h3 class="section__title">Tổng giỏ hàng</h3>
                    <table class="order__table">
                        <thead>
                            <tr>
                                <th colspan="2">Sản phẩm</th>
                                <th>Giá tiền</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <img src="Uploads/images/<?= $product["image"] ?>" alt="" class="order__img" />
                                </td>
                                <td>
                                    <h3 class="table__title"><?= $product["product_name"] ?></h3>
                                    <p class="table__quantity">x<?= $product["quantity"] ?></p>
                                </td>
                                <td><span class="table__price"><?= number_format($product["price"] * $product["quantity"]) ?> đ</span></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><span class="order__subtitle">Tổng phụ</span></td>
                                <td colspan="2"><span class="table__price">
                                    <?php
                                        $totalPrice = 0;
                                        foreach ($products as $product) {
                                            $totalPrice += ($product["price"] * $product["quantity"]);
                                        }
                                        echo number_format($totalPrice) . " đ";
                                    ?>
                                </span></td>
                            </tr>
                            <tr>
                                <td><span class="order__subtitle">Giảm giá</span></td>
                                <td colspan="2"><span class="table__price">
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
                                <td><span class="order__subtitle">Vận chuyển</span></td>
                                <td colspan="2">
                                    <span class="table__price">Miễn phí</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order__subtitle">Tổng cộng</span></td>
                                <td colspan="2">
                                    <span class="order__grand-total">
                                        <?php
                                            $finalTotal = $totalPrice - $discountAmount;
                                            echo number_format($finalTotal) . " đ";
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="checkout__group">
                    <h3 class="section__title">Chi tiết thanh toán</h3>
                    <form action="index.php?page=checkout&action=handle" method="post" class="form grid">
                        <input type="text" placeholder="Họ và tên" class="form__input" name="full_name" />
                        <select id="province" class="form__input" name="province_name">
                            <option value="">Chọn Tỉnh/Thành</option>
                        </select>
                        <select id="district" class="form__input" disabled name="district_name">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                        <select id="ward" class="form__input" disabled name="ward_name">
                            <option value="">Chọn Phường/Xã</option>
                        </select>
                        <input type="text" placeholder="Địa chỉ chi tiết (Số nhà, Tên đường)" class="form__input" name="address_line" />
                        <input type="text" placeholder="Số điện thoại" class="form__input" name="phone_number" />
                        <input type="email" placeholder="Địa chỉ email" class="form__input" name="email" />
                        <h3 class="checkout__title">Thông tin bổ sung</h3>
                        <textarea name="order_notes" placeholder="Ghi chú đơn hàng" class="form__input textarea"></textarea>
                        <h3 class="checkout__title">Thanh toán</h3>
                        <div class="flex">
                            <input type="radio" name="payment_method" id="l1" value="bank_transfer" checked class="payment__input" />
                            <label for="l1" class="payment__label" style="cursor: pointer;">Chuyển khoản ngân hàng</label>
                        </div>
                        <div class="flex">
                            <input type="radio" name="payment_method" id="l2" value="cash_on_delivery" class="payment__input" />
                            <label for="l2" class="payment__label" style="cursor: pointer;">Thanh toán khi nhận hàng</label>
                        </div>
                        <button type="submit" class="btn btn--md" style="cursor: pointer;">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const provinceSelect = document.getElementById('province');
                const districtSelect = document.getElementById('district');
                const wardSelect = document.getElementById('ward');
                async function fetchData(url) {
                    try {
                        const response = await fetch(url);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return await response.json();
                    } catch (error) {
                        console.error("Lỗi khi lấy dữ liệu:", error);
                        return [];
                    }
                }
                async function loadProvinces() {
                    const provinces = await fetchData('https://provinces.open-api.vn/api/?depth=1');
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.name;
                        option.textContent = province.name;
                        option.dataset.code = province.code;
                        provinceSelect.appendChild(option);
                    });
                }
                async function loadDistricts(provinceCode) {
                    districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                    districtSelect.disabled = true;
                    wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                    wardSelect.disabled = true;
                    if (provinceCode) {
                        const districtsData = await fetchData(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
                        if (districtsData && districtsData.districts) {
                            districtsData.districts.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.name;
                                option.textContent = district.name;
                                option.dataset.code = district.code;
                                districtSelect.appendChild(option);
                            });
                            districtSelect.disabled = false;
                        }
                    }
                }
                async function loadWards(districtCode) {
                    wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                    wardSelect.disabled = true;
                    if (districtCode) {
                        const wardsData = await fetchData(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                        if (wardsData && wardsData.wards) {
                            wardsData.wards.forEach(ward => {
                                const option = document.createElement('option');
                                option.value = ward.name;
                                option.textContent = ward.name;
                                option.dataset.code = ward.code;
                                wardSelect.appendChild(option);
                            });
                            wardSelect.disabled = false;
                        }
                    }
                }
                provinceSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const selectedProvinceCode = selectedOption ? selectedOption.dataset.code : '';
                    loadDistricts(selectedProvinceCode);
                });
                districtSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const selectedDistrictCode = selectedOption ? selectedOption.dataset.code : '';
                    loadWards(selectedDistrictCode);
                });
                loadProvinces();
            });
        </script>