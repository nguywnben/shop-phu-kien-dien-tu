        <?php

        $errors = $_SESSION["errors"] ?? [];
        $old_data = $_SESSION["old_data"] ?? [];
        $failed = $_SESSION["failed"] ?? "";
        $successful = $_SESSION["successful"] ?? "";
        unset($_SESSION["errors"], $_SESSION["old_data"], $_SESSION["successful"], $_SESSION["failed"]);

        ?>
        <section class="login-register section--lg">
            <div class="login-register__container container grid">
                <div class="login">
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
                    <h3 class="section__title">Đăng nhập tài khoản</h3>
                    <form action="index.php?page=login&action=handle" method="post" class="form grid">
                        <input type="text" name="email" placeholder="Địa chỉ email" class="form__input" value="<?= $old_data["email"] ?? "" ?>" />
                        <?php if (isset($errors["email"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["email"] ?></div>
                        <?php endif; ?>
                        <input type="password" name="password" placeholder="Mật khẩu" class="form__input" value="<?= $old_data["password"] ?? "" ?>" />
                        <?php if (isset($errors["password"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["password"] ?></div>
                        <?php endif; ?>
                        <div style="text-align: right; margin-bottom: 1rem;">
                            <a href="index.php?page=forgot-password&action=index" style="color: blue; text-decoration: none; font-size: 14px;">Quên mật khẩu?</a>
                        </div>
                        <div class="form__btn">
                            <button type="submit" name="login" style="cursor: pointer;" class="btn">Xác nhận</button>
                        </div>
                    </form>
                </div>
                <div class="register">
                    <h3 class="section__title">Bạn chưa có tài khoản?</h3>
                    <div>
                        <p>Tham gia với chúng mình để tận hưởng ưu đãi và trải nghiệm mua sắm tuyệt vời nhất.</p><br>
                        <div class="form__btn">
                            <a href="index.php?page=register&action=index" class="btn">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>