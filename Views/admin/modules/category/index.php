<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
    <div x-data="{ open: true }" x-show="open" 
         class="rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15 mb-4 relative">
        
        <div class="flex items-start gap-3 mr-6"> <div class="-mt-0.5 text-error-500">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""/>
                </svg>
            </div>

            <div>
                <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Lỗi</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['error']) ?></p>
            </div>
        </div>

        <button type="button" @click="open = false" 
                class="absolute top-1/2 transform -translate-y-1/2 right-4 text-error-500 hover:text-error-700 dark:text-error-400 dark:hover:text-error-200 p-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
    <div x-data="{ open: true }" x-show="open"
         class="rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15 mb-4 relative">
        
        <div class="flex items-start gap-3 mr-6"> <div class="-mt-0.5 text-success-500">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""/>
                </svg>
            </div>

            <div>
                <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Thành công</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['success']) ?></p>
            </div>
        </div>

        <button type="button" @click="open = false" 
                class="absolute top-1/2 transform -translate-y-1/2 right-4 text-success-500 hover:text-success-700 dark:text-success-400 dark:hover:text-success-200 p-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<main>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <div x-data="{ pageName: `Quản lý Danh mục` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="admin.php">
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
        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                        Danh sách
                    </h3>
                    <a href="?page=categories&action=add"
                        class="inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-500 px-3 py-2 text-sm font-medium text-white transition duration-300 ease-out hover:bg-brand-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Thêm danh mục
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    ID
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Thông tin sơ bộ
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Ngày tạo
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Ngày sửa
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Trạng thái
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Thao tác
                                                </p>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        <?= $category['id'] ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 overflow-hidden rounded-full">
                                                            <img src="Assets/client/img/<?= $category['image'] ?>"
                                                                alt="thumbnail" />
                                                        </div>
                                                        <div>
                                                            <span
                                                                class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                                <?= $category['name'] ?>
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        <?= $category['create_at'] ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        <?= $category['update_at'] ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <?php if ($category['status'] == 1): ?>
                                                        <p
                                                            class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                            Hiển thị
                                                        </p>
                                                    <?php else: ?>
                                                        <p
                                                            class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                                            Đang ẩn
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="admin.php?page=categories&action=edit&id=<?= $category['id'] ?>"
                                                    class="inline-flex items-center justify-center gap-1 rounded-full bg-blue-light-50 px-2.5 py-0.5 text-sm font-medium text-blue-light-500 dark:bg-blue-light-500/15 dark:text-blue-light-500 ">
                                                    Sửa <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form method="post" action="admin.php?page=categories&action=delete"
                                                    onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?');"
                                                    style="display:inline">
                                                    <input type="hidden" name="id" value="<?= $category['id'] ?>" />
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center gap-1 rounded-full bg-error-50 px-2.5 py-0.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                                        Xóa <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        // Hiển thị phân trang nếu có nhiều hơn 1 trang
        if (isset($pagination) && $pagination['totalPages'] > 1): ?>
        <div class="w-full flex flex-col items-center justify-center mt-6 mb-4">
            <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Hiển thị 
                <span class="font-semibold text-brand-600 dark:text-brand-400"><?= $pagination['totalCategories'] - ($pagination['currentPage'] - 1) * $pagination['limit'] ?></span> 
                đến 
                <span class="font-semibold text-brand-600 dark:text-brand-400"><?= max($pagination['totalCategories'] - $pagination['currentPage'] * $pagination['limit'] + 1, 1) ?></span> 
                trên tổng số 
                <span class="font-semibold text-brand-600 dark:text-brand-400"><?= $pagination['totalCategories'] ?></span> danh mục.
            </div>
            <nav class="flex flex-wrap gap-1 justify-center items-center" aria-label="Pagination">
                <!-- Previous -->
                <a href="?page=categories&action=index&page_num=<?= $pagination['currentPage'] - 1 ?>"
                   class="px-3 py-1 rounded-full border border-gray-300 bg-white text-gray-500 hover:bg-brand-100 hover:text-brand-700 transition disabled:opacity-50 disabled:pointer-events-none"
                   style="<?= $pagination['currentPage'] <= 1 ? 'pointer-events:none;opacity:0.5;' : '' ?>">
                    &laquo;
                </a>
                <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                    <a href="?page=categories&action=index&page_num=<?= $i ?>"
                       class="px-3 py-1 rounded-full border text-sm font-medium transition
                       <?= ($i == $pagination['currentPage']) 
                           ? 'bg-brand-500 border-brand-500 text-white shadow' 
                           : 'bg-white border-gray-300 text-gray-700 hover:bg-brand-100 hover:text-brand-700' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                <!-- Next -->
                <a href="?page=categories&action=index&page_num=<?= $pagination['currentPage'] + 1 ?>"
                   class="px-3 py-1 rounded-full border border-gray-300 bg-white text-gray-500 hover:bg-brand-100 hover:text-brand-700 transition disabled:opacity-50 disabled:pointer-events-none"
                   style="<?= $pagination['currentPage'] >= $pagination['totalPages'] ? 'pointer-events:none;opacity:0.5;' : '' ?>">
                    &raquo;
                </a>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</main>