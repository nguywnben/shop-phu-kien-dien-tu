    <?php

    require_once "Models/CartModel.php";
    $cartItemCount = 0;

    if (isset($_SESSION["login"])) {
        $userId = $_SESSION["login"]["id"];
        $cartModel = new CartModel();
        $cartItemCount = $cartModel->getTotalUniqueProductsInCart($userId);
    }

    ?>
    <header class="header">
        <div class="header__top">
            <div class="header__container container">
                <div class="header__contact">
                    <span>(+84) 0797 164 052</span>
                    <span>22 Thường Thạnh, Cái Răng, Cần Thơ</span>
                </div>
                <p class="header__alert-news">
                    Ưu Đãi Giá Trị Lớn - Tiết kiệm nhiều hơn với phiếu giảm giá
                </p>
                <?php if (isset($_SESSION["login"])): ?>
                    <a href="index.php?page=account&id=<?= $_SESSION["login"]["id"] ?>" class="header__top-action">
                        <?= $_SESSION["login"]["name"] ?>
                    </a>
                <?php else: ?>
                    <a href="index.php?page=login&action=index" class="header__top-action">
                        Đăng nhập / Đăng ký
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <img class="nav__logo-img" src="Assets/client/img/logo.png" alt="logo trang web" style="width: 200px;"/>
            </a>
            <div class="nav__menu" id="nav-menu">
                <div class="nav__menu-top">
                    <a href="index.php" class="nav__menu-logo">
                        <img src="Assets/client/img/logo.svg" alt="" />
                    </a>
                    <div class="nav__close" id="nav-close">
                        <i class="fi fi-rs-cross-small"></i>
                    </div>
                </div>
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.php" class="nav__link active-link">Trang Chủ</a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?page=shop" class="nav__link">Cửa Hàng</a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?page=blog" class="nav__link">Bài Viết</a>
                    </li>
                </ul>
                <form class="header__search" method="GET" action="index.php">
                    <input type="hidden" name="page" value="" />
                    <input type="text" name="q" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" placeholder="Tìm kiếm sản phẩm..." class="form__input" />
                    <button class="search__btn" type="submit">
                        <img src="Assets/client/img/search.png" alt="biểu tượng tìm kiếm" />
                    </button>
                </form>
            </div>
            <div class="header__user-actions">
                <a href="index.php?page=wishlist" class="header__action-btn" title="Danh sách yêu thích">
                    <img src="Assets/client/img/icon-heart.svg" alt="" />
                    <span class="count">3</span>
                </a>
                <a href="index.php?page=cart&action=index" class="header__action-btn" title="Giỏ hàng">
                    <img src="Assets/client/img/icon-cart.svg" alt="" />
                    <span class="count"><?= $cartItemCount ?></span>
                </a>
                <div class="header__action-btn nav__toggle" id="nav-toggle">
                    <img src="Assets/client//img/menu-burger.svg" alt="" />
                </div>
            </div>
        </nav>
    </header>

    <main class="main">