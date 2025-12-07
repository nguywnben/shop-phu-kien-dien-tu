        <?php

        $errors = $_SESSION["errors"] ?? [];
        $failed = $_SESSION["failed"] ?? "";
        $successful = $_SESSION["successful"] ?? "";
        $token = $_GET["token"] ?? "";
        unset($_SESSION["errors"], $_SESSION["successful"], $_SESSION["failed"]);

        if (empty($token)) {
            $_SESSION["failed"] = "Liên kết đặt lại mật khẩu không hợp lệ.";
            header("location: index.php?page=login&action=index");
            exit;
        }

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
                    <h3 class="section__title">Đặt lại mật khẩu</h3>
                    <p style="margin-bottom: 1.5rem;">Vui lòng nhập mật khẩu mới của bạn.</p>
                    <form action="index.php?page=reset-password&action=handle" method="post" class="form grid">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>"> 
                        <input type="password" name="password" placeholder="Nhập mật khẩu mới" class="form__input" />
                        <?php if (isset($errors["password"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["password"] ?></div>
                        <?php endif; ?>
                        <input type="password" name="repassword" placeholder="Nhập lại mật khẩu mới" class="form__input" />
                        <?php if (isset($errors["repassword"])): ?>
                            <div style="color: red; font-size: 14px;"><?= $errors["repassword"] ?></div>
                        <?php endif; ?>
                        <div class="form__btn">
                            <button type="submit" name="reset-password" style="cursor: pointer;" class="btn">Xác nhận</button>
                        </div>
                        <div style="text-align: center; margin-top: 1rem;">
                            <a href="index.php?page=login&action=index" style="color: blue; text-decoration: none; font-size: 14px;">Quay lại Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>