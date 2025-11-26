<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-4 flex items-center justify-between rounded-lg bg-error-500 px-4 py-3 text-white shadow-md">
        <div class="flex items-center gap-2">
            <svg class="h-5 w-5 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span class="text-sm font-medium"><?= htmlspecialchars($_SESSION['error']) ?></span>
        </div>

        <button @click="show = false" class="ml-auto text-white/70 hover:text-white focus:outline-none">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php
// Khởi tạo session để lưu trữ thông báo lỗi
$name_error = $_SESSION['name_error'] ?? "";
$status_error = $_SESSION['status_error'] ?? "";
$image_error = $_SESSION['image_error'] ?? "";
?>

<?php
// Lấy dữ liệu cũ từ DB hoặc session
$name_old = $_SESSION['name_old'] ?? ($category['name'] ?? "");
$status_old = $_SESSION['status_old'] ?? ($category['status'] ?? "");
?>
<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: 'Chỉnh sửa Danh mục'}">
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
                        <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="?page=categories&action=update" method="POST" enctype="multipart/form-data">

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Thông tin chung
                            </h3>
                        </div>

                        <div class="p-5 space-y-6 sm:p-6">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    ID danh mục
                                </label>
                                <input type="text" name="id" value="<?= htmlspecialchars($category['id']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tên danh mục <span class="text-error-500">*</span>
                                </label>

                                <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30 
                                <?= !empty($_SESSION['name_error'])
                                    ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                    : 'text-gray-800 dark:text-white/90'
                                    ?>" />

                                <?php if (!empty($_SESSION['name_error'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $_SESSION['name_error'] ?>
                                    </p>
                                    <?php unset($_SESSION['name_error']); ?>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Cấu hình hiển thị
                            </h3>
                        </div>
                        <div class="p-5 space-y-6 sm:p-6">

                            <div>
                                <label for="status"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Trạng thái
                                </label>

                                <div class="relative z-20 bg-transparent">
                                    <select id="status" name="status"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

                                        <option value="" disabled <?= empty($status_old) ? 'selected' : '' ?>>
                                            Vui lòng chọn trạng thái
                                        </option>

                                        <option value="1" <?= (string) $status_old === '1' ? 'selected' : '' ?>>
                                            Hiển thị
                                        </option>

                                        <option value="0" <?= (string) $status_old === '0' ? 'selected' : '' ?>>
                                            Ẩn
                                        </option>
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                <?php if (!empty($status_error)): ?>
                                    <p class="mt-1.5 text-xs text-red-500"><?= $status_error ?></p>
                                <?php endif; ?>
                            </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Hình ảnh
                                </label>
                                <input type="file" name="image"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 pt-6 dark:border-gray-800">
                <a href="admin.php?page=categories&action=index"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Hủy bỏ
                </a>
                <button type="submit" name="btn_update"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Cập nhật
                </button>
            </div>

        </form>
    </div>
</main>
<?php
unset($_SESSION['name_error'], $_SESSION['status_error'], $_SESSION['image_error']);
unset($_SESSION['name_old'], $_SESSION['status_old']);
?>