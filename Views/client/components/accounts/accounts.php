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
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($orders)) : ?>
                                    <?php foreach ($orders as $order) : ?>
                                        <tr>
                                            <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                            <td>
                                                <?php
                                                    switch ($order['shipping_status']) {
                                                        case 1:
                                                            echo 'Đang xử lý';
                                                            break;
                                                        case 2:
                                                            echo 'Đã hoàn thành';
                                                            break;
                                                        case 3:
                                                            echo 'Đã hủy';
                                                            break;
                                                        default:
                                                            echo 'Không xác định';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo number_format($order['grand_total'], 0, ',', '.'); ?>₫</td>
                                          
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">Bạn chưa có đơn hàng nào.</td>
                                    </tr>
                                <?php endif; ?>
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
               
               
                </div>
            </div>
        </section>