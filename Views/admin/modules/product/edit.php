
<?php


// Biến lỗi và dữ liệu cũ từ phiên (session)
$name_error = $_SESSION['name_error'] ?? "";
$sku_model_error = $_SESSION['sku_model_error'] ?? "";
$price_error = $_SESSION['price_error'] ?? "";
$category_id_error = $_SESSION['category_id_error'] ?? "";
$status_error = $_SESSION['status_error'] ?? "";
$thumbnail_error = $_SESSION['thumbnail_error'] ?? "";


// Biến lưu trữ giá trị cũ (old input) nếu validation thất bại
$name_old = $_SESSION['name_old'] ?? '';
$sku_model_old = $_SESSION['sku_model_old'] ?? '';
$description_old = $_SESSION['description_old'] ?? '';
$content_old = $_SESSION['content_old'] ?? '';
$price_old = $_SESSION['price_old'] ?? '';
$category_id_old = $_SESSION['category_id_old'] ?? '';
$brand_id_old = $_SESSION['brand_id_old'] ?? '';
$brand_name_old = $_SESSION['brand_name_old'] ?? '';
$main_image_old = $_SESSION['main_image_old'] ?? '';
$status_old = $_SESSION['status_old'] ?? '';
$is_featured_old = $_SESSION['is_featured_old'] ?? '';



// Gán giá trị sản phẩm hiện tại cho biến 'old' nếu không có dữ liệu cũ từ session
$product_id = $product['id'] ?? null;
$name_value = $name_old ?: ($product['name'] ?? '');
$sku_model_value = $sku_model_old ?: ($product['sku_model'] ?? '');
$description_value = $description_old ?: ($product['description'] ?? '');
$content_value = $content_old ?: ($product['content'] ?? '');
$price_value = $price_old ?: ($product['price'] ?? '');
$category_id_value = $category_id_old ?: ($product['category_id'] ?? '');
$brand_id_value = $brand_id_old ?: ($product['brand_id'] ?? '');
$brand_name_value = $brand_name_old ?: ($product['brand_name'] ?? '');
$main_image_value = $main_image_old ?: ($product['main_image_url'] ?? '');
$status_value = $status_old ?: ($product['status'] ?? '');
$is_featured_value = $is_featured_old ?: ($product['is_featured'] ?? '');




?>
<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: 'Sửa Sản phẩm'}">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="index.html">
                                Trang chủ
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="?page=products&action=index">
                                Danh sách Sản phẩm
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
        <div
            class="rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15 mb-4">
            <div class="flex items-start gap-3">
                <div class="-mt-0.5 text-error-500">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                            fill="" />
                    </svg>
                </div>
                <div>
                    <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Lỗi</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['error']) ?></p>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
        <div
            class="rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15 mb-4">
            <div class="flex items-start gap-3">
                <div class="-mt-0.5 text-success-500">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                            fill="" />
                    </svg>
                </div>

                <div>
                    <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Thành công</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['success']) ?>
                    </p>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form id="edit-product" method="POST" action="?page=products&action=update&id=<?= htmlspecialchars($product_id) ?>"
            enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= htmlspecialchars($product_id) ?>">

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                <div class="space-y-6">
                    <div
                        class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Thông tin chung & Đặc
                                điểm</h3>
                        </div>

                        <div class="p-5 space-y-6 sm:p-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tên sản
                                    phẩm <span class="text-error-500">*</span></label>
                                <input type="text" name="name" id="productName"
                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                    placeholder="Nhập tên sản phẩm" 
                                    value="<?= htmlspecialchars($name_value) ?>" />
                                <?php if ($name_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $name_error ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Mã SKU
                                    hoặc Model</label>
                                <input type="text" name="sku_model" id="skuModel"
                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                    placeholder="Ví dụ: SP001A"
                                    value="<?= htmlspecialchars($sku_model_value) ?>" />
                                <?php if ($sku_model_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $sku_model_error ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Mô tả
                                    ngắn</label>
                                <textarea name="description" id="shortDescription" rows="2"
                                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                    placeholder="Tóm tắt về sản phẩm"><?= htmlspecialchars($description_value) ?></textarea>
                            </div>

                            <div>
                                <label
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nội dung
                                    chi tiết sản phẩm</label>
                                <textarea name="content" id="content" rows="4"
                                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                    placeholder="Mô tả chi tiết, thông số kỹ thuật"><?= htmlspecialchars($content_value) ?></textarea>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Ảnh đại
                                    diện sản phẩm</label>
                                <?php if (!empty($product['main_image_url'])): ?>
                           
                                <img src="../../../../Assets/client/img/<?= htmlspecialchars($main_image_value) ?>" style="width:60px;" alt="Ảnh hiện tại"
                                    class="mb-2 w-32 h-auto rounded-lg border border-gray-200 dark:border-gray-700"
                                    />
                                <?php endif; ?>

                                <input type="file" name="thumbnail" id="productThumbnail"
                                    class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />
                                <input type="hidden" name="old_thumbnail"
                                    value="<?= htmlspecialchars($product['thumbnail'] ?? '') ?>">
                                <?php if ($thumbnail_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $thumbnail_error ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div
                        class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Cấu hình hiển thị</h3>
                        </div>
                        <div class="p-5 space-y-6 sm:p-6">

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Giá sản
                                    phẩm <span class="text-error-500">*</span></label>
                                <input type="number" name="price" id="price"
                                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                    placeholder="0" min="0"  value="<?= htmlspecialchars($price_value) ?>" />
                                <?php if ($price_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $price_error ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="cate_id"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Danh mục
                                    <span class="text-error-500">*</span></label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="cate_id" name="category_id"
                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                        >
                                        <option value="" disabled>Vui lòng chọn danh mục</option>
                                        <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"
                                            <?= ($category_id_value == $cat['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if ($category_id_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $category_id_error ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="brand_id"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Thương
                                    hiệu</label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="brand_id" name="brand_id"
                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800">
                                        <option value="">Không có thương hiệu</option>
                                        <?php foreach ($brands as $brand): ?>
                                        <option value="<?= $brand['id'] ?>"
                                            <?= ($brand_id_value == $brand['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($brand['name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="status"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Trạng thái
                                    <span class="text-error-500">*</span></label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="status" name="status"
                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                                        >
                                        <option value="" disabled>Vui lòng chọn trạng thái</option>
                                        <option value="1" <?= ($status_value == '1') ? 'selected' : '' ?>>Hiển thị
                                        </option>
                                        <option value="0" <?= ($status_value == '0') ? 'selected' : '' ?>>Ẩn</option>
                                    </select>
                                </div>
                                <?php if ($status_error): ?>
                                <p class="mt-1 text-sm text-error-500"><?= $status_error ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="is_featured"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nổi
                                    bật</label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="is_featured" name="is_featured"
                                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800">
                                        <option value="0" <?= ($is_featured_value == '0') ? 'selected' : '' ?>>Không
                                        </option>
                                        <option value="1" <?= ($is_featured_value == '1') ? 'selected' : '' ?>>Nổi bật
                                        </option>
                                    </select>
                                </div>
                            </div>

                       

                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <a href="?page=products&action=index"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700">Hủy
                    bỏ</a>
                <button type="submit" name="btn_edit"
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 flex h-11 items-center justify-center rounded-lg border border-transparent bg-success-500 px-4 py-2.5 text-sm font-medium text-white transition duration-300 ease-out hover:bg-success-600 dark:bg-success-600 dark:hover:bg-success-700">Lưu
                    thay đổi</button>
            </div>
        </form>
        <?php
        // Xóa dữ liệu cũ sau khi render trang
        unset(
            $_SESSION['name_old'], 
            $_SESSION['sku_model_old'], 
            $_SESSION['description_old'], 
            $_SESSION['content_old'], 
            $_SESSION['price_old'], 
            $_SESSION['category_id_old'], 
            $_SESSION['brand_id_old'], 
            $_SESSION['status_old'], 
            $_SESSION['is_featured_old']
        );
        ?>
    </div>
</main>