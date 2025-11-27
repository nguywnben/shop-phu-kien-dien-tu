        <section class="products container section--lg">
            <p class="total__products">Chúng tôi tìm thấy <span><?php echo isset($totalProducts) ? (int)$totalProducts : 0; ?></span> sản phẩm cho bạn!</p>
            <div class="products__container grid">
                <?php foreach ($products as $product): ?>
                    <?php
                    $defaultImg = 'Assets/client/img/product-1-1.jpg';
                    $hoverImg = $defaultImg;
                    $serverRoot = dirname(__DIR__, 4);
                    $resolveCandidate = function ($val) use ($serverRoot) {
                        if (empty($val)) return null;
                        if (strpos($val, '/') !== false || strpos($val, '\\') !== false) {
                            $path = $serverRoot . DIRECTORY_SEPARATOR . $val;
                            if (file_exists($path)) return $val;
                            $alt = 'Assets/client/img/' . basename($val);
                            if (file_exists($serverRoot . DIRECTORY_SEPARATOR . $alt)) return $alt;
                            return $val;
                        }
                        $cand = 'Assets/client/img/' . $val;
                        if (file_exists($serverRoot . DIRECTORY_SEPARATOR . $cand)) return $cand;

                        $cand2 = 'uploads/products/' . $val;
                        if (file_exists($serverRoot . DIRECTORY_SEPARATOR . $cand2)) return $cand2;
                        return $val;
                    };
                    if (!empty($product['images']) && is_array($product['images'])) {
                        $d = $resolveCandidate($product['images'][0]);
                        $h = isset($product['images'][1]) ? $resolveCandidate($product['images'][1]) : $d;
                        if ($d) $defaultImg = $d;
                        if ($h) $hoverImg = $h;
                    } elseif (!empty($product['thumbnail'])) {
                        $t = $resolveCandidate($product['thumbnail']);
                        if ($t) {
                            $defaultImg = $t;
                            $hoverImg = $t;
                        }
                    }
                    ?>
                    <div class="product__item">
                        <div class="product__banner">
                            <a href="index.php?page=details&product_id=<?php echo $product['id']; ?>" class="product__images">
                                <img src="<?php echo htmlspecialchars($defaultImg); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product__img default" />
                                <img src="<?php echo htmlspecialchars($hoverImg); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product__img hover" />
                            </a>
                            <div class="product__actions">
                                <a href="#" class="action__btn" aria-label="Xem Nhanh">
                                    <i class="fi fi-rs-eye"></i>
                                </a>
                                <a href="#" class="action__btn" aria-label="Thêm vào Danh sách yêu thích">
                                    <i class="fi fi-rs-heart"></i>
                                </a>
                                <a href="#" class="action__btn" aria-label="So Sánh">
                                    <i class="fi fi-rs-shuffle"></i>
                                </a>
                            </div>
                            <div class="product__badge light-pink">Hot</div>
                        </div>
                        <div class="product__content">
                            <span class="product__category"><?php echo $product['category_id']; ?></span>
                            <a href="details.html">
                                <h3 class="product__title"><?php echo $product['name']; ?></h3>
                            </a>
                            <div class="product__rating">
                                <i class="fi fi-rs-star"></i>
                                <i class="fi fi-rs-star"></i>
                                <i class="fi fi-rs-star"></i>
                                <i class="fi fi-rs-star"></i>
                                <i class="fi fi-rs-star"></i>
                            </div>
                            <div class="product__price flex">
                                <span class="new__price"><?php echo $product['price']; ?></span>
                                <span class="old__price"><?php echo $product['price']; ?></span>
                            </div>
                            <a href="#" class="action__btn cart__btn" aria-label="Thêm vào Giỏ hàng">
                                <i class="fi fi-rs-shopping-bag-add"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <?php if (isset($totalPages) && $totalPages > 1): ?>
                <ul class="pagination">
                    <?php
                    $baseUrl = 'index.php?page=shop';
                    $cur = isset($currentPage) ? (int)$currentPage : 1;
                    $tp = isset($totalPages) ? (int)$totalPages : 1;
                    $start = max(1, $cur - 2);
                    $end = min($tp, $cur + 2);
                    if ($cur > 1) {
                        $prev = $cur - 1;
                        echo '<li><a href="' . $baseUrl . '&p=' . $prev . '" class="pagination__link icon"><i class="fi-rs-angle-double-small-left"></i></a></li>';
                    }
                    if ($start > 1) {
                        echo '<li><a href="' . $baseUrl . '&p=1" class="pagination__link">1</a></li>';
                        if ($start > 2) echo '<li><span class="pagination__dots">...</span></li>';
                    }
                    for ($i = $start; $i <= $end; $i++) {
                        $active = $i === $cur ? ' active' : '';
                        echo '<li><a href="' . $baseUrl . '&p=' . $i . '" class="pagination__link' . $active . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</a></li>';
                    }
                    if ($end < $tp) {
                        if ($end < $tp - 1) echo '<li><span class="pagination__dots">...</span></li>';
                        echo '<li><a href="' . $baseUrl . '&p=' . $tp . '" class="pagination__link">' . $tp . '</a></li>';
                    }
                    if ($cur < $tp) {
                        $next = $cur + 1;
                        echo '<li><a href="' . $baseUrl . '&p=' . $next . '" class="pagination__link icon"><i class="fi-rs-angle-double-small-right"></i></a></li>';
                    }
                    ?>
                </ul>
            <?php endif; ?>
        </section>