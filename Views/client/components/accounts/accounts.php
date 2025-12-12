        <section class="accounts section--lg">
            <div class="accounts__container container grid">
                <div class="account__tabs">
                    <p class="account__tab active-tab" data-target="#dashboard">
                        <i class="fi fi-rs-settings-sliders"></i> Bảng Điều Khiển
                    </p>
                    <p class="account__tab" data-target="#orders">
                        <i class="fi fi-rs-shopping-bag"></i> Đơn Hàng
                    </p>
                    <p class="account__tab" data-target="#update-profile">
                        <i class="fi fi-rs-user"></i> Cập Nhật Hồ Sơ
                    </p>
                    <p class="account__tab" data-target="#address">
                        <i class="fi fi-rs-marker"></i> Địa Chỉ Của Tôi
                    </p>
                    <p class="account__tab" data-target="#change-password">
                        <i class="fi fi-rs-settings-sliders"></i> Đổi Mật Khẩu
                    </p>
                    <a href="index.php?page=logout" class="account__tab" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');"><i class="fi fi-rs-exit"></i> Đăng Xuất</a>
                </div>
                <div class="tabs__content">
                    <div class="tab__content active-tab" content id="dashboard">
                        <h3 class="tab__header">Xin Chào <?php echo htmlspecialchars($user['name'] ?? ''); ?></h3>
                        <div class="tab__body">
                            <p class="tab__description">
                                Email: <?php echo htmlspecialchars($user['email'] ?? ''); ?><br>
                                Số điện thoại: <?php echo htmlspecialchars($user['phone'] ?? 'Chưa cập nhật'); ?><br>
                                Vai trò: <?php echo (isset($user['role']) && $user['role'] == 1) ? 'Admin' : 'Khách hàng'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="tab__content" content id="orders">
                        <h3 class="tab__header">Đơn Hàng Của Bạn</h3>
                        <div class="tab__body">
                            <table class="placed__order-table">
                                <thead>
                                    <tr>
                                        <th>Đơn hàng</th>
                                        <th>Ngày</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng cộng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#1357</td>
                                        <td>Ngày 19 tháng 3, 2022</td>
                                        <td>Đang xử lý</td>
                                        <td>3.125.000₫</td>
                                        <td><a href="#" class="view__order">Xem</a></td>
                                    </tr>
                                    <tr>
                                        <td>#2468</td>
                                        <td>Ngày 29 tháng 6, 2022</td>
                                        <td>Đã hoàn thành</td>
                                        <td>9.100.000₫</td>
                                        <td><a href="#" class="view__order">Xem</a></td>
                                    </tr>
                                    <tr>
                                        <td>#2366</td>
                                        <td>Ngày 02 tháng 8, 2022</td>
                                        <td>Đã hoàn thành</td>
                                        <td>7.000.000₫</td>
                                        <td><a href="#" class="view__order">Xem</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab__content" content id="update-profile">
                        <h3 class="tab__header">Cập Nhật Hồ Sơ</h3>
                        <div class="tab__body">
                            <form class="form grid" method="POST" action="index.php?page=account&action=update">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" placeholder="Tên người dùng" class="form__input" required />
                                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="Email" class="form__input" disabled />
                                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="Số điện thoại" class="form__input" />
                                <div class="form__btn">
                                    <button class="btn btn--md" type="submit">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab__content" content id="address">
                        <h3 class="tab__header">Địa Chỉ Giao Hàng</h3>
                        <div class="tab__body">
                            <address class="address">
                                3522 Interstate <br />
                                75 Business Spur, <br />
                                Sault Ste. <br />
                                Marie, Mi 49783
                            </address>
                            <p class="city">New York</p>
                            <a href="#" class="edit">Chỉnh sửa</a>
                        </div>
                    </div>
                    <div class="tab__content" content id="change-password">
                        <h3 class="tab__header">Đổi Mật Khẩu</h3>
                        <div class="tab__body">
                            <form class="form grid">
                                <input type="password" placeholder="Mật khẩu hiện tại" class="form__input" />
                                <input type="password" placeholder="Mật khẩu mới" class="form__input" />
                                <input type="password" placeholder="Xác nhận mật khẩu" class="form__input" />
                                <div class="form__btn">
                                    <button class="btn btn--md">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>