        <?php

        $errors = $_SESSION["errors"] ?? [];
        $old_data = $_SESSION["old_data"] ?? [];
        $failed = $_SESSION["failed"] ?? "";
        $successful = $_SESSION["successful"] ?? "";
        unset($_SESSION["errors"], $_SESSION["old_data"], $_SESSION["successful"], $_SESSION["failed"]);

        ?>
        <section class="login-register section--lg">
            <div class="login-register__container container grid" style="grid-template-columns: 1fr;">
                <div class="login" style="max-width: 400px; margin: 0 auto;">
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
                    <h3 class="section__title">Quên mật khẩu</h3>
                    <p style="margin-bottom: 1.5rem;">Vui lòng nhập địa chỉ email bạn đã đăng ký. Chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>
                    <form action="index.php?page=forgot-password&action=handle" method="post" class="form grid">
                        <input type="text" name="email" placeholder="Nhập địa chỉ email" class="form__input" value="<?= $old_data["email"] ?? "" ?>" />
                        <?php if (isset($errors["email"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["email"] ?></div>
                        <?php endif; ?>
                        <div class="form__btn">
                            <button type="submit" name="forgot-password" style="cursor: pointer;" class="btn">Xác nhận</button>
                        </div>
                        <div style="text-align: center; margin-top: 1rem;">
                            <a href="index.php?page=login&action=index" style="color: blue; text-decoration: none; font-size: 14px;">Quay lại Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>