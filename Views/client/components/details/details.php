        <section class="details section--lg">
            <div class="details__container container grid">
                <div class="details__group">
                    <?php
                    $images = isset($product['images']) ? $product['images'] : [];
                    function _img_url($u)
                    {
                        if (empty($u)) return 'Assets/client/img/product-8-1.jpg';
                        if (strpos($u, 'http') === 0 || strpos($u, '/') === 0) return $u;
                        if (strpos($u, 'uploads') !== false || strpos($u, 'Assets') !== false) return $u;
                        return 'Assets/client/img/' . $u;
                    }
                    $mainImg = _img_url($images[0] ?? ($product['main_image_url'] ?? ''));
                    ?>
                    <img src="<?php echo htmlspecialchars($mainImg); ?>" alt="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" class="details__img" />
                    <div class="details__small-images grid">
                        <?php
                        $small = $images;
                        if (empty($small) && !empty($product['main_image_url'])) {
                            $small[] = $product['main_image_url'];
                        }
                        $small = array_slice($small, 0, 4);
                        foreach ($small as $si) {
                            echo '<img src="' . htmlspecialchars(_img_url($si)) . '" alt="' . htmlspecialchars($product['name'] ?? '') . '" class="details__small-img" />';
                        }
                        ?>
                    </div>
                </div>
                <div class="details__group">
                    <h3 class="details__title"><?php echo htmlspecialchars($product['name'] ?? ''); ?></h3>
                    <p class="details__brand">Thương hiệu: <span><?php echo htmlspecialchars($product['brand_id'] ?? ''); ?></span></p>
                    <div class="details__price flex">
                        <span class="new__price"><?php echo isset($product['price']) ? number_format($product['price'], 0, ',', '.') . '₫' : ''; ?></span>
                    </div>
                    <p class="short__description"><?php echo nl2br(htmlspecialchars($product['description'] ?? '')); ?></p>
                    <ul class="products__list">
                        <li class="list__item flex">
                            <i class="fi-rs-crown"></i> Bảo hành: <?php echo htmlspecialchars($product['warranty'] ?? 'Liên hệ nhà bán'); ?>
                        </li>
                        <li class="list__item flex">
                            <i class="fi-rs-refresh"></i> Chính sách đổi trả: 30 ngày
                        </li>
                        <li class="list__item flex">
                            <i class="fi-rs-credit-card"></i> Thanh toán: COD / Online
                        </li>
                    </ul>
                    <div class="details__action">
                        <input type="number" class="quantity" value="1" />
                        <a href="#" class="btn btn--sm">Thêm vào Giỏ hàng</a>
                        <a href="#" class="details__action-btn">
                            <i class="fi fi-rs-heart"></i>
                        </a>
                    </div>
                    <ul class="details__meta">
                        <li class="meta__list flex"><span>Mã SKU:</span><?php echo htmlspecialchars($product['sku_model'] ?? ''); ?></li>
                        <li class="meta__list flex">
                            <span>Tags:</span><?php echo htmlspecialchars($product['tags'] ?? ''); ?>
                        </li>
                        <li class="meta__list flex">
                            <span>Tình trạng:</span><?php echo (isset($product['status']) && $product['status'] == 1) ? 'Còn hàng' : 'Hết hàng'; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </section>