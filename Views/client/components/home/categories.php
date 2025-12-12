        <section class="categories container section">
            <h3 class="section__title"><span>Danh mục</span> Phổ biến</h3>
            <div class="categories__container swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($categories as $category): ?>
                        <a href="index.php?page=shop&category_id=<?php echo $category['id']; ?>" class="category__item swiper-slide">
                            <img src="Assets/client/img/<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="category__img" />
                            <h3 class="category__title"><?php echo htmlspecialchars($category['name']); ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-button-prev">
                    <i class="fi fi-rs-angle-left"></i>
                </div>
                <div class="swiper-button-next">
                    <i class="fi fi-rs-angle-right"></i>
                </div>
            </div>
        </section>  