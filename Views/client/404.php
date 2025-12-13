<?php 

if (!headers_sent()) {
    http_response_code(404);
}
?>
<?php require_once 'header.php'; ?>

<main>
    <section class="error-404 section--lg">
        <div class="container grid">
            <div class="error-404__content text-center mx-auto max-w-xl">
                
                <h1 class="error-404__code text-9xl font-extrabold text-brand-500 mb-6">404</h1>
                
                <h2 class="error-404__title section__title mb-4">
                    <span>Ôi không!</span> Trang này không tồn tại
                </h2>

                <p class="error-404__description text-gray-600 mb-8">
                    Chúng tôi rất tiếc, trang bạn đang tìm kiếm đã bị di chuyển, xóa, hoặc không tồn tại.
                    Hãy thử các đường dẫn dưới đây.
                </p>

                <div class="error-404__actions flex justify-center gap-4">
                    
                    <a href="index.php" class="btn btn--md">
                        <i class="fi fi-rs-home mr-2"></i> Về Trang Chủ
                    </a>

                    <button onclick="history.back()" class="btn btn--md btn--secondary">
                        <i class="fi fi-rs-arrow-left mr-2"></i> Quay Lại
                    </button>
                    
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>