        <section class="wishlist section--lg container">
            <div class="table__container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Xóa</th>
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Trạng thái Kho hàng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($wishlistItems)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">
                                    <p>Bạn chưa có sản phẩm nào trong danh sách yêu thích.</p>
                                    <a href="index.php?page=shop" class="btn btn--sm" style="margin-top: 20px;">Tiếp tục mua sắm</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($wishlistItems as $item): 
                                $productImg = 'Assets/client/img/product-1-1.jpg';
                                if (!empty($item['images']) && is_array($item['images'])) {
                                    $imgUrl = $item['images'][0];
                                    if (!empty($imgUrl)) {
                                        if (strpos($imgUrl, '/') !== false || strpos($imgUrl, '\\') !== false) {
                                            $productImg = $imgUrl;
                                        } else {
                                            $productImg = 'Assets/client/img/' . $imgUrl;
                                        }
                                    }
                                } elseif (!empty($item['main_image_url'])) {
                                    $productImg = $item['main_image_url'];
                                }
                            ?>
                            <tr>
                                <td>
                                    <form method="POST" action="index.php?page=wishlist&action=remove" style="display: inline;">
                                        <input type="hidden" name="wishlist_id" value="<?php echo htmlspecialchars($item['wishlist_id']); ?>" />
                                        <button type="submit" style="background: none; border: none; cursor: pointer; color: inherit;">
                                            <i class="fi fi-rs-trash table__trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($productImg); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="table__img" />
                                </td>
                                <td>
                                    <h3 class="table__title">
                                        <a href="index.php?page=details&product_id=<?php echo $item['product_id']; ?>">
                                            <?php echo htmlspecialchars($item['name']); ?>
                                        </a>
                                    </h3>
                                    <p class="table__description">
                                        <?php echo htmlspecialchars(substr($item['description'] ?? '', 0, 100)); ?>
                                        <?php echo strlen($item['description'] ?? '') > 100 ? '...' : ''; ?>
                                    </p>
                                </td>
                                <td><span class="table__price"><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</span></td>
                                <td><span class="table__stock"><?php echo htmlspecialchars($item['stock_status']); ?></span></td>
                                <td>
                                    <a href="index.php?page=cart&action=add&product_id=<?php echo $item['product_id']; ?>" class="btn btn--sm">Thêm vào Giỏ hàng</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>