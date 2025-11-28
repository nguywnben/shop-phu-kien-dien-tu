        <?php

        $errors = $_SESSION["errors"] ?? [];
        $old_data = $_SESSION["old_data"] ?? [];
        $failed = $_SESSION["failed"] ?? "";
        unset($_SESSION["errors"], $_SESSION["old_data"], $_SESSION["failed"]);

        ?>
        <section class="login-register section--lg">
            <div class="login-register__container container grid">
                <div class="login">
                    <h3 class="section__title">Bạn đã có tài khoản?</h3>
                    <div>
                        <p>Đăng nhập để tiếp tục mua sắm và theo dõi đơn hàng của bạn.</p><br>
                        <div class="form__btn">
                            <a href="index.php?page=login&action=index" class="btn">Đăng nhập ngay</a>
                        </div>
                    </div>
                </div>
                <div class="register">
                    <?php if ($failed): ?>
                        <div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border-radius: .25rem;" role="alert">
                            <?= $failed ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="section__title">Đăng ký tài khoản</h3>
                    <form action="index.php?page=register&action=handle" method="post" class="form grid">
                        <input type="text" name="name" placeholder="Họ và tên" class="form__input" value="<?= $old_data["name"] ?? "" ?>" />
                        <?php if (isset($errors["name"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["name"] ?></div>
                        <?php endif; ?>
                        <input type="text" name="email" placeholder="Địa chỉ email" class="form__input" value="<?= $old_data["email"] ?? "" ?>" />
                        <?php if (isset($errors["email"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["email"] ?></div>
                        <?php endif; ?>
                        <input type="password" name="password" placeholder="Mật khẩu" class="form__input" value="<?= $old_data["password"] ?? "" ?>" />
                        <?php if (isset($errors["password"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["password"] ?></div>
                        <?php endif; ?>
                        <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" class="form__input" value="<?= $old_data["repassword"] ?? "" ?>" />
                        <?php if (isset($errors["repassword"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["repassword"] ?></div>
                        <?php endif; ?>
                        <div class="form__btn">
                            <button type="submit" name="register" style="cursor: pointer;" class="btn">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>