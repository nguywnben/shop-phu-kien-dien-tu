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
// Khởi tạo session để lưu trữ thông báo lỗi và dữ liệu cũ
// Giả định các biến lỗi và dữ liệu cũ mới:
$code_error = $_SESSION['code_error'] ?? "";
$max_discount_error = $_SESSION['max_discount_error'] ?? "";
$min_order_total_error = $_SESSION['min_order_total_error'] ?? "";
$usage_limit_error = $_SESSION['usage_limit_error'] ?? "";
$start_at_error = $_SESSION['start_at_error'] ?? "";
$end_at_error = $_SESSION['end_at_error'] ?? "";
$status_error = $_SESSION['status_error'] ?? "";

// Lấy dữ liệu cũ từ DB (biến $discount_code thay vì $category) hoặc session
// Giả định dữ liệu mã giảm giá được lưu trong biến $discount_code
$code_old = $_SESSION['code_old'] ?? ($coupons['code'] ?? "");
$max_discount_old = $_SESSION['max_discount_old'] ?? ($coupons['max_discount'] ?? "");
$min_order_total_old = $_SESSION['min_order_total_old'] ?? ($coupons['min_order_total'] ?? "");
$usage_limit_old = $_SESSION['usage_limit_old'] ?? ($coupons['usage_limit'] ?? "");
$start_at_old = $_SESSION['start_at_old'] ?? ($coupons['start_at'] ?? "");
$end_at_old = $_SESSION['end_at_old'] ?? ($coupons['end_at'] ?? "");
$status_old = $_SESSION['status_old'] ?? ($coupons['status'] ?? "");

// Xóa các biến dữ liệu cũ và lỗi category không còn dùng
unset($_SESSION['name_error'], $_SESSION['image_error']);
unset($_SESSION['name_old']);
?>
<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: 'Chỉnh sửa Mã giảm giá'}">
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
                                href="admin.php?page=coupons&action=index">
                                Mã giảm giá
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

        <form action="?page=discounts&action=update" method="POST">

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Thông tin cơ bản
                            </h3>
                        </div>

                        <div class="p-5 space-y-6 sm:p-6">
                            <input type="hidden" name="id" value="<?= $coupon['id'] ?>">

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    ID Mã giảm giá
                                </label>
                                <input type="text" name="id_display" value="<?= htmlspecialchars($coupon['id']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Số tiền giảm tối đa (Nếu là % thì đây là giới hạn) <span class="text-error-500">*</span>
                                </label>
                                <input type="number" name="max_discount" value="<?= htmlspecialchars($coupon['max_discount']) ?>"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30
                                    <?= !empty($max_discount_error)
                                        ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                        : 'text-gray-800 dark:text-white/90'
                                        ?>" />
                                <?php if (!empty($max_discount_error)): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $max_discount_error ?>
                                    </p>
                                    <?php unset($_SESSION['max_discount_error']); ?>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Giá trị đơn tối thiểu để áp dụng
                                </label>
                                <input type="number" name="min_order_total" value="<?= htmlspecialchars($coupon['min_order_total']) ?>"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30
                                    <?= !empty($min_order_total_error)
                                        ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                        : 'text-gray-800 dark:text-white/90'
                                        ?>" />
                                <?php if (!empty($min_order_total_error)): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $min_order_total_error ?>
                                    </p>
                                    <?php unset($_SESSION['min_order_total_error']); ?>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Giới hạn số lần sử dụng
                                </label>
                                <input type="number" name="usage_limit" value="<?= htmlspecialchars($coupon['usage_limit']) ?>"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30
                                    <?= !empty($usage_limit_error)
                                        ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                        : 'text-gray-800 dark:text-white/90'
                                        ?>" />
                                <?php if (!empty($usage_limit_error)): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $usage_limit_error ?>
                                    </p>
                                    <?php unset($_SESSION['usage_limit_error']); ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Cấu hình thời gian & trạng thái
                            </h3>
                        </div>
                        <div class="p-5 space-y-6 sm:p-6">

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Thời gian bắt đầu
                                </label>
                                <input type="datetime-local" name="start_at" value="<?= htmlspecialchars($coupon['start_at']) ?>"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30
                                    <?= !empty($start_at_error)
                                        ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                        : 'text-gray-800 dark:text-white/90'
                                        ?>" />
                                <?php if (!empty($start_at_error)): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $start_at_error ?>
                                    </p>
                                    <?php unset($_SESSION['start_at_error']); ?>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Thời gian kết thúc
                                </label>
                                <input type="datetime-local" name="end_at" value="<?= htmlspecialchars($coupon['end_at']) ?>"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30
                                    <?= !empty($end_at_error)
                                        ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10 placeholder:text-error-300'
                                        : 'text-gray-800 dark:text-white/90'
                                        ?>" />
                                <?php if (!empty($end_at_error)): ?>
                                    <p class="mt-1.5 text-xs text-error-500">
                                        <?= $end_at_error ?>
                                    </p>
                                    <?php unset($_SESSION['end_at_error']); ?>
                                <?php endif; ?>
                            </div>

                            </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 pt-6 dark:border-gray-800">
                <a href="admin.php?page=coupons&action=index"
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
unset(
    $_SESSION['code_error'], $_SESSION['max_discount_error'], $_SESSION['min_order_total_error'],
    $_SESSION['usage_limit_error'], $_SESSION['start_at_error'], $_SESSION['end_at_error'], $_SESSION['status_error'],
    $_SESSION['code_old'], $_SESSION['max_discount_old'], $_SESSION['min_order_total_old'],
    $_SESSION['usage_limit_old'], $_SESSION['start_at_old'], $_SESSION['end_at_old'], $_SESSION['status_old']
);
?>