        <section class="blog-detail section--lg container">
            <article class="post">
                <div class="post__header">
                    <h1 class="post__title"><?php echo htmlspecialchars($post['title']); ?></h1>
                    <div class="post__meta">
                        <span class="post__date">
                            <i class="fi fi-rs-calendar"></i>
                            <?php echo date('d/m/Y H:i', strtotime($post['published_at'] ?? $post['created_at'])); ?>
                        </span>
                        <span class="post__author">
                            <i class="fi fi-rs-user"></i>
                            Admin
                        </span>
                    </div>
                </div>

                <?php if (!empty($post['cover_image'])): ?>
                    <div class="post__cover">
                        <img src="<?php echo htmlspecialchars($post['cover_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post__cover-img" />
                    </div>
                <?php endif; ?>

                <div class="post__content">
                    <?php echo $post['content']; ?>
                </div>

                <div class="post__footer">
                    <a href="index.php?page=blog" class="btn btn--md">
                        <i class="fi fi-rs-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
            </article>
        </section>

        <style>
            .blog-detail {
                max-width: 900px;
                margin: 0 auto;
            }

            .post {
                background: #fff;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .post__header {
                margin-bottom: 2rem;
            }

            .post__title {
                font-size: 2.5rem;
                color: #333;
                margin-bottom: 1rem;
                line-height: 1.2;
            }

            .post__meta {
                display: flex;
                gap: 2rem;
                color: #666;
                font-size: 0.95rem;
            }

            .post__meta span {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .post__cover {
                width: 100%;
                margin-bottom: 2rem;
                border-radius: 8px;
                overflow: hidden;
            }

            .post__cover-img {
                width: 100%;
                height: auto;
                display: block;
            }

            .post__content {
                line-height: 1.8;
                color: #444;
                font-size: 1.05rem;
            }

            .post__content h2 {
                font-size: 1.75rem;
                margin: 2rem 0 1rem;
                color: #333;
            }

            .post__content h3 {
                font-size: 1.5rem;
                margin: 1.5rem 0 0.75rem;
                color: #333;
            }

            .post__content p {
                margin-bottom: 1.25rem;
            }

            .post__content img {
                max-width: 100%;
                height: auto;
                border-radius: 4px;
                margin: 1.5rem 0;
            }

            .post__content ul, .post__content ol {
                margin: 1rem 0;
                padding-left: 2rem;
            }

            .post__content li {
                margin-bottom: 0.5rem;
            }

            .post__content blockquote {
                border-left: 4px solid #ff6b6b;
                padding-left: 1.5rem;
                margin: 1.5rem 0;
                font-style: italic;
                color: #666;
            }

            .post__footer {
                margin-top: 3rem;
                padding-top: 2rem;
                border-top: 1px solid #e0e0e0;
            }

            @media (max-width: 768px) {
                .post {
                    padding: 1.5rem;
                }

                .post__title {
                    font-size: 2rem;
                }

                .post__meta {
                    flex-direction: column;
                    gap: 0.5rem;
                }
            }
        </style>
