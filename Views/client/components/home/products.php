        <section class="products container section">
            <div class="tab__btns">
                <span class="tab__btn active-tab" data-target="#featured">Nổi bật</span>
                <span class="tab__btn" data-target="#popular">Phổ biến</span>
                <span class="tab__btn" data-target="#new-added">Mới ra mắt</span>
            </div>

            <div class="tab__items">
                <div class="tab__item active-tab" content id="featured">
                    <div class="products__container grid">
                       <?php foreach ($products as $product): ?>
                            <div class="product__item">
                            <div class="product__banner">
                                <a href="details.html" class="product__images">
                                    <img src="Assets/client/img/product-1-1.jpg" alt="" class="product__img default" />
                                    <img src="Assets/client/img/product-1-2.jpg" alt="" class="product__img hover" />
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
                </div>
            </div>
        </section>