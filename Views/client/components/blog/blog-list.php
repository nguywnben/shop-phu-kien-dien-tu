        <section class="blog section--lg container">
            <h2 class="section__title">Bài Viết Mới Nhất</h2>
            
            <div class="blog__container grid">
                <?php if (empty($posts)): ?>
                    <p style="text-align: center; padding: 40px; grid-column: 1/-1;">Chưa có bài viết nào.</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <article class="blog__post">
                            <div class="blog__img-wrapper">
                                <a href="index.php?page=blog&action=detail&post_id=<?php echo $post['id']; ?>">
                                    <?php 
                                    $coverImage = !empty($post['cover_image']) ? $post['cover_image'] : 'Assets/client/img/blog-1.jpg';
                                    ?>
                                    <img src="<?php echo htmlspecialchars($coverImage); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="blog__img" />
                                </a>
                            </div>
                            <div class="blog__content">
                                <div class="blog__meta">
                                    <span class="blog__date">
                                        <i class="fi fi-rs-calendar"></i>
                                        <?php echo date('d/m/Y', strtotime($post['published_at'] ?? $post['created_at'])); ?>
                                    </span>
                                    <span class="blog__author">
                                        <i class="fi fi-rs-user"></i>
                                        Admin
                                    </span>
                                </div>
                                <h3 class="blog__title">
                                    <a href="index.php?page=blog&action=detail&post_id=<?php echo $post['id']; ?>">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </h3>
                                <p class="blog__excerpt">
                                    <?php 
                                    $content = strip_tags($post['content']);
                                    echo htmlspecialchars(substr($content, 0, 150));
                                    echo strlen($content) > 150 ? '...' : '';
                                    ?>
                                </p>
                                <a href="index.php?page=blog&action=detail&post_id=<?php echo $post['id']; ?>" class="blog__read-more">
                                    Đọc thêm <i class="fi fi-rs-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <style>
            .blog__container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 2rem;
                margin-top: 2rem;
            }
            
            .blog__post {
                background: #fff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s;
            }
            
            .blog__post:hover {
                transform: translateY(-5px);
            }
            
            .blog__img-wrapper {
                width: 100%;
                height: 200px;
                overflow: hidden;
            }
            
            .blog__img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s;
            }
            
            .blog__post:hover .blog__img {
                transform: scale(1.1);
            }
            
            .blog__content {
                padding: 1.5rem;
            }
            
            .blog__meta {
                display: flex;
                gap: 1rem;
                margin-bottom: 0.75rem;
                font-size: 0.875rem;
                color: #666;
            }
            
            .blog__meta span {
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }
            
            .blog__title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .blog__title a {
                color: #333;
                text-decoration: none;
            }
            
            .blog__title a:hover {
                color: #ff6b6b;
            }
            
            .blog__excerpt {
                color: #666;
                line-height: 1.6;
                margin-bottom: 1rem;
            }
            
            .blog__read-more {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: #ff6b6b;
                text-decoration: none;
                font-weight: 500;
            }
            
            .blog__read-more:hover {
                gap: 0.75rem;
            }
        </style>
