        <section class="cart section--lg container">
            <div class="table__container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="Assets/client//img/product-1-2.jpg" alt="" class="table__img" />
                            </td>
                            <td>
                                <h3 class="table__title">
                                    Áo Sơ Mi Nữ Tay Ngắn J.Crew Mercantile
                                </h3>
                                <p class="table__description">
                                    Đây là mô tả ngắn về sản phẩm.
                                </p>
                            </td>
                            <td>
                                <span class="table__price">2.750.000₫</span>
                            </td>
                            <td><input type="number" value="3" class="quantity" /></td>
                            <td><span class="subtotal">8.250.000₫</span></td>
                            <td><i class="fi fi-rs-trash table__trash"></i></td>
                        </tr>
                        <tr>
                            <td>
                                <img src="Assets/client//img/product-7-1.jpg" alt="" class="table__img" />
                            </td>
                            <td>
                                <h3 class="table__title">Áo Ba Lỗ Nữ Amazon Essentials</h3>
                                <p class="table__description">
                                    Đây là mô tả ngắn về sản phẩm.
                                </p>
                            </td>
                            <td>
                                <span class="table__price">2.750.000₫</span>
                            </td>
                            <td><input type="number" value="3" class="quantity" /></td>
                            <td><span class="subtotal">8.250.000₫</span></td>
                            <td><i class="fi fi-rs-trash table__trash"></i></td>
                        </tr>
                        <tr>
                            <td>
                                <img src="Assets/client//img/product-2-1.jpg" alt="" class="table__img" />
                            </td>
                            <td>
                                <h3 class="table__title">
                                    Thương Hiệu Amazon - Áo Jersey Nữ Daily Ritual
                                </h3>
                                <p class="table__description">
                                    Đây là mô tả ngắn về sản phẩm.
                                </p>
                            </td>
                            <td>
                                <span class="table__price">2.750.000₫</span>
                            </td>
                            <td><input type="number" value="3" class="quantity" /></td>
                            <td><span class="subtotal">8.250.000₫</span></td>
                            <td><i class="fi fi-rs-trash table__trash"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cart__actions">
                <a href="#" class="btn flex btn__md">
                    <i class="fi-rs-shuffle"></i> Cập nhật Giỏ hàng
                </a>
                <a href="#" class="btn flex btn__md">
                    <i class="fi-rs-shopping-bag"></i> Tiếp tục Mua sắm
                </a>
            </div>

            <div class="divider">
                <i class="fi fi-rs-fingerprint"></i>
            </div>

            <div class="cart__group grid">
                <div>
                    <div class="cart__shippinp">
                        <h3 class="section__title">Tính Phí Vận Chuyển</h3>
                        <form action="" class="form grid">
                            <input type="text" class="form__input" placeholder="Tỉnh / Quốc gia" />
                            <div class="form__group grid">
                                <input type="text" class="form__input" placeholder="Thành phố" />
                                <input type="text" class="form__input" placeholder="Mã bưu chính" />
                            </div>
                            <div class="form__btn">
                                <button class="btn flex btn--sm">
                                    <i class="fi-rs-shuffle"></i> Cập nhật
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="cart__coupon">
                        <h3 class="section__title">Áp dụng Mã giảm giá</h3>
                        <form action="" class="coupon__form form grid">
                            <div class="form__group grid">
                                <input type="text" class="form__input" placeholder="Nhập Mã giảm giá của bạn" />
                                <div class="form__btn">
                                    <button class="btn flex btn--sm">
                                        <i class="fi-rs-label"></i> Áp dụng
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="cart__total">
                    <h3 class="section__title">Tổng tiền Giỏ hàng</h3>
                    <table class="cart__total-table">
                        <tr>
                            <td><span class="cart__total-title">Tổng phụ Giỏ hàng</span></td>
                            <td><span class="cart__total-price">6.000.000₫</span></td>
                        </tr>
                        <tr>
                            <td><span class="cart__total-title">Vận chuyển</span></td>
                            <td><span class="cart__total-price">250.000₫</span></td>
                        </tr>
                        <tr>
                            <td><span class="cart__total-title">Tổng cộng</span></td>
                            <td><span class="cart__total-price">6.250.000₫</span></td>
                        </tr>
                    </table>
                    <a href="checkout.html" class="btn flex btn--md">
                        <i class="fi fi-rs-box-alt"></i> Tiến hành Thanh toán
                    </a>
                </div>
            </div>
        </section>