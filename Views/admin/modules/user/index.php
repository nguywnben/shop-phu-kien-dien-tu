            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <div x-data="{ pageName: `Quản lý Người dùng` }">
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
                    <div class="space-y-5 sm:space-y-6">
                        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="px-5 py-4 sm:px-6 sm:py-5">
                                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                    Danh sách
                                </h3>
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
                                                                Email
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
                                                <?php foreach ($users as $user): ?>
                                                    <tr>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    <?= $user['id'] ?>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 overflow-hidden rounded-full">
                                                                        <img src="Assets/client/avatars/<?= $user['avatar'] ?>"
                                                                            alt="avatar" />
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                                            <?= $user['name'] ?>
                                                                        </span>
                                                                        <?php if ($user['role'] == 1): ?>
                                                                            <span
                                                                                class="inline-block rounded-full bg-primary-50 px-2 py-0.5 text-theme-xs font-medium text-primary-700 dark:bg-primary-500/15 dark:text-primary-500">
                                                                                Admin
                                                                            </span>
                                                                        <?php else: ?>
                                                                            <span
                                                                                class="inline-block text-gray-500 text-theme-xs dark:text-gray-400">
                                                                                Người dùng
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                    <?= $user['email'] ?>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <?php if ($user['status'] == 1): ?>
                                                                    <p
                                                                        class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                                        Hoạt động
                                                                    </p>
                                                                <?php else: ?>
                                                                    <p
                                                                        class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500">
                                                                        Bị khóa
                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <!-- Thêm thẻ td cho nút sử và xóa chỗ này -->
                                                    </tr>
                                                <? endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>