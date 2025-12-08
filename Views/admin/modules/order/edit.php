<?php
$errors = $_SESSION["errors"] ?? [];
unset($_SESSION["errors"]);

$order = $order ?? [];
$orderItems = $orderItems ?? [];

$recipient_name = $order['recipient_name'] ?? '';
$recipient_phone = $order['phone'] ?? '';
$shipping_address = $order['address_line'] ?? '';
$note = $order['note'] ?? '';

?>
<main>
    <div class="mx-auto max-w-7xl p-4 md:p-6">
        <div x-data="{ pageName: 'Chi tiết Đơn hàng'}">
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
                                href="admin.php?page=orders&action=index">
                                Quản lý đơn hàng
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

        <form action="?page=orders&action=update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($order['id'] ?? '') ?>">
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Thông tin người nhận
                        </h3>
                    </div>
                    <div class="p-5 space-y-3 sm:p-6"> 
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400"><strong>Tên:</strong> <?= htmlspecialchars($recipient_name) ?></p>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400"><strong>Điện thoại:</strong> <?= htmlspecialchars($recipient_phone) ?></p>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400"><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($shipping_address) ?></p>
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400"><strong>Ghi chú:</strong> <?= htmlspecialchars($note) ?></p>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Cập nhật Trạng thái
                        </h3>
                    </div>
                    <div class="p-5 space-y-6 sm:p-6">

                        <div>
                            <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Trạng thái đơn hàng
                            </label>
                            <select id="status" name="status" class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90">
                                <option value="1" <?= ($order['status'] ?? 0) == 1 ? 'selected' : '' ?>>Chờ xác nhận</option>
                                <option value="2" <?= ($order['status'] ?? 0) == 2 ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="3" <?= ($order['status'] ?? 0) == 3 ? 'selected' : '' ?>>Đang giao</option>
                                <option value="4" <?= ($order['status'] ?? 0) == 4 ? 'selected' : '' ?>>Hoàn thành</option>
                                <option value="5" <?= ($order['status'] ?? 0) == 5 ? 'selected' : '' ?>>Hủy</option>
                            </select>
                            <?php if (isset($errors['status'])): ?>
                                <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['status']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="payment_status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Trạng thái thanh toán
                            </label>
                            <select id="payment_status" name="payment_status" class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90">
                                <option value="0" <?= ($order['payment_status'] ?? 0) == 0 ? 'selected' : '' ?>>Chưa thanh toán</option>
                                <option value="1" <?= ($order['payment_status'] ?? 0) == 1 ? 'selected' : '' ?>>Đã thanh toán</option>
                            </select>
                            <?php if (isset($errors['payment_status'])): ?>
                                <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['payment_status']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <label for="shipping_status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Trạng thái giao hàng
                            </label>
                            <select id="shipping_status" name="shipping_status" class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90">
                                <option value="0" <?= ($order['shipping_status'] ?? 0) == 0 ? 'selected' : '' ?>>Chờ vận chuyển</option>
                                <option value="1" <?= ($order['shipping_status'] ?? 0) == 1 ? 'selected' : '' ?>>Đang giao</option>
                                <option value="2" <?= ($order['shipping_status'] ?? 0) == 2 ? 'selected' : '' ?>>Đã giao</option>
                            </select>
                            <?php if (isset($errors['shipping_status'])): ?>
                                <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['shipping_status']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>

            </div> <div class="space-y-6"> 
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Chi tiết sản phẩm
                        </h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-fixed">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Sản phẩm</th> 
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Số lượng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Giá</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                <?php 
                                $subTotal = 0;
                                foreach ($orderItems as $item): 
                                    $qty = $item['quantity'] ?? $item['qty'] ?? 1;
                                    $price = $item['price'] ?? $item['unit_price'] ?? 0;
                                    $itemTotal = $qty * $price;
                                    $subTotal += $itemTotal;
                                ?>
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white overflow-hidden text-wrap">
                                            <?= htmlspecialchars($item['product_name'] ?? $item['product_name_from_db'] ?? 'Sản phẩm không tên') ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <?= $qty ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <?= number_format($price, 0, ',', '.') ?> VND
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <?= number_format($itemTotal, 0, ',', '.') ?> VND
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <div class="mt-4 border-t pt-4 text-right dark:border-gray-700">
                            <p class="text-lg font-semibold">Tổng phụ: <?= number_format($subTotal, 0, ',', '.') ?> VND</p>
                            <p class="text-xl font-bold mt-2">Tổng thanh toán: <?= number_format($order['grand_total'] ?? 0, 0, ',', '.') ?> VND</p>
                        </div>
                    </div>
                </div>
            </div> <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 pt-6 dark:border-gray-800">
                <a href="admin.php?page=orders&action=index"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Hủy bỏ
                </a>
                <button type="submit" name="btn_update"
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 flex h-11 items-center justify-center rounded-lg border border-transparent bg-success-500 px-4 py-2.5 text-sm font-medium text-white transition duration-300 ease-out hover:bg-success-600 dark:bg-success-600 dark:hover:bg-success-700">
                    Cập nhật Trạng thái
                </button>
            </div>
        </form>
    </div>
</main>