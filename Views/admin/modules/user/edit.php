<?php

$errors = $_SESSION["errors"] ?? "";
unset($_SESSION["errors"]);

?>
<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: 'Chỉnh sửa Người dùng'}">
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

        <form action="?page=users&action=update" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Thông tin chung
                            </h3>
                        </div>
                        <div class="p-5 space-y-6 sm:p-6">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    ID người dùng
                                </label>
                                <input type="text" id="id" name="id" value="<?= htmlspecialchars($user['id']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Họ và tên <span class="text-error-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Nhập họ và tên" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30" />
                                <?php if (isset($errors["name"])): ?>
                                    <div class="text-theme-xs text-error-500 mt-1.5"><?= $errors["name"] ?></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Địa chỉ email <span class="text-error-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Nhập địa chỉ email" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30" />
                                <?php if (isset($errors["email"])): ?>
                                    <div class="text-theme-xs text-error-500 mt-1.5"><?= $errors["email"] ?></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Số điện thoại
                                </label>
                                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Nhập số điện thoại" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:placeholder:text-white/30" />
                                <?php if (isset($errors["phone"])): ?>
                                    <div class="text-theme-xs text-error-500 mt-1.5"><?= $errors["phone"] ?></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="role"
                                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Chức quyền
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select id="role" name="role"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="1" <?= (string) $user["role"] === '1' ? 'selected' : '' ?>>
                                            Admin
                                        </option>
                                        <option value="0" <?= (string) $user["role"] === '0' ? 'selected' : '' ?>>
                                            Thành viên
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
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Ảnh đại diện
                                </label>
                                <div class="flex items-center">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 overflow-hidden rounded-full">
                                            <img src="Assets/client/img/<?= htmlspecialchars($user["avatar"]) ?>" alt="avatar" />
                                        </div>
                                        <div>
                                            <input id="avatar" name="avatar" type="file" class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Cấu hình
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
                                        <option value="1" <?= (string) $user["status"] === '1' ? 'selected' : '' ?>>
                                            Hoạt động
                                        </option>
                                        <option value="0" <?= (string) $user["status"] === '0' ? 'selected' : '' ?>>
                                            Khóa
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
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Đăng nhập gần nhất
                                </label>
                                <input type="text" id="last_login_at" name="last_login_at" value="<?= htmlspecialchars($user['last_login_at']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Cập nhật mới nhất
                                </label>
                                <input type="text" id="updated_at" name="updated_at" value="<?= htmlspecialchars($user['updated_at']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Ngày tạo tài khoản
                                </label>
                                <input type="text" id="created_at" name="created_at" value="<?= htmlspecialchars($user['created_at']) ?>" disabled
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 pt-6 dark:border-gray-800">
                <a href="admin.php?page=users&action=index"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Hủy bỏ
                </a>
                <button type="submit" name="edit"
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 flex h-11 items-center justify-center rounded-lg border border-transparent bg-success-500 px-4 py-2.5 text-sm font-medium text-white transition duration-300 ease-out hover:bg-success-600 dark:bg-success-600 dark:hover:bg-success-700">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</main>