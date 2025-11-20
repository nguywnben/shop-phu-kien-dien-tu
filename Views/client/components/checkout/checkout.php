        <section class="checkout section--lg">
            <div class="checkout__container container grid">
                <div class="checkout__group">
                    <h3 class="section__title">Chi Tiết Thanh Toán</h3>
                    <form class="form grid">
                        <input type="text" placeholder="Họ và Tên" class="form__input" />
                        <input type="text" placeholder="Địa chỉ" class="form__input" />
                        <input type="text" placeholder="Thành phố" class="form__input" />
                        <input type="text" placeholder="Quốc gia" class="form__input" />
                        <input type="text" placeholder="Mã bưu chính" class="form__input" />
                        <input type="text" placeholder="Điện thoại" class="form__input" />
                        <input type="email" placeholder="Email" class="form__input" />
                        <h3 class="checkout__title">Thông Tin Bổ Sung</h3>
                        <textarea name="" placeholder="Ghi chú đơn hàng" class="form__input textarea"></textarea>
                    </form>
                </div>
                <div class="checkout__group">
                    <h3 class="section__title">Tổng tiền Giỏ hàng</h3>
                    <table class="order__table">
                        <thead>
                            <tr>
                                <th colspan="2">Sản phẩm</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <img src="../../Assets/client/img/product-1-2.jpg" alt="" class="order__img" />
                                </td>
                                <td>
                                    <h3 class="table__title">Yidarton Women Summer Blue</h3>
                                    <p class="table__quantity">x 2</p>
                                </td>
                                <td><span class="table__price">4.500.000₫</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="../../Assets/client/img/product-2-1.jpg" alt="" class="order__img" />
                                </td>
                                <td>
                                    <h3 class="table__title">LDB Moon Summer</h3>
                                    <p class="table__quantity">x 1</p>
                                </td>
                                <td><span class="table__price">1.625.000₫</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="../../Assets/client/img/product-7-1.jpg" alt="" class="order__img" />
                                </td>
                                <td>
                                    <h3 class="table__title">Women Short Sleeve Loose</h3>
                                    <p class="table__quantity">x 2</p>
                                </td>
                                <td><span class="table__price">875.000₫</span></td>
                            </tr>
                            <tr>
                                <td><span class="order__subtitle">Tạm tính</span></td>
                                <td colspan="2"><span class="table__price">7.000.000₫</span></td>
                            </tr>
                            <tr>
                                <td><span class="order__subtitle">Vận chuyển</span></td>
                                <td colspan="2">
                                    <span class="table__price">Miễn phí vận chuyển</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order__subtitle">Tổng cộng</span></td>
                                <td colspan="2">
                                    <span class="order__grand-total">7.000.000₫</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="payment__methods">
                        <h3 class="checkout__title payment__title">Phương thức Thanh toán</h3>
                        <div class="payment__option flex">
                            <input type="radio" name="radio" id="l1" checked class="payment__input" />
                            <label for="l1" class="payment__label">Chuyển khoản Ngân hàng Trực tiếp</label>
                        </div>
                        <div class="payment__option flex">
                            <input type="radio" name="radio" id="l2" class="payment__input" />
                            <label for="l2" class="payment__label">Thanh toán bằng Séc</label>
                        </div>
                        <div class="payment__option flex">
                            <input type="radio" name="radio" id="l3" class="payment__input" />
                            <label for="l3" class="payment__label">Paypal</label>
                        </div>
                    </div>
                    <button class="btn btn--md">Đặt Hàng</button>
                </div>
            </div>
        </section>