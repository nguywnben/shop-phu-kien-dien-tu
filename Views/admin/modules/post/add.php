<?php

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$title_old = $_SESSION['title_old'] ?? '';
$slug_old = $_SESSION['slug_old'] ?? '';
$content_old = $_SESSION['content_old'] ?? '';
$cover_image_old = $_SESSION['cover_image_old'] ?? '';
$author_id_old = $_SESSION['author_id_old'] ?? '';
$status_old = $_SESSION['status_old'] ?? '1';
?>
<main>
    <div class="mx-auto max-w-7xl p-4 md:p-6">
        <div x-data="{ pageName: 'Thêm bài viết'}">
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
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="admin.php?page=posts&action=index">
                                Quản lý bài viết
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
            <div x-data="{ open: true }" x-show="open" 
                 class="rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15 mb-4 relative">
                <div class="flex items-start gap-3">
                    <div class="-mt-0.5 text-error-500">
                        <svg class="fill-current w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z" fill=""/></svg>
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

        <form action="?page=posts&action=store" method="POST" enctype="multipart/form-data">
            
            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Thông tin bài viết
                            </h3>
                        </div>

                        <div class="p-5 space-y-6 sm:p-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tiêu đề bài viết <span class="text-error-500">*</span>
                                </label>
                                <input type="text" name="title" value="<?= htmlspecialchars($title_old, ENT_QUOTES) ?>" 
                                    placeholder="Nhập tiêu đề bài viết" 
                                    class="h-11 w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30
                                    <?= isset($errors['title']) ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10' : 'focus:border-brand-300 focus:ring-brand-500/10' ?>" />
                                <?php if (isset($errors['title'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['title']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Đường dẫn SEO (Slug) <span class="text-error-500">*</span>
                                </label>
                                <input type="text" name="slug" value="<?= htmlspecialchars($slug_old, ENT_QUOTES) ?>" 
                                    placeholder="vd: bai-viet-hay-nhat" 
                                    class="h-11 w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30
                                    <?= isset($errors['slug']) ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10' : 'focus:border-brand-300 focus:ring-brand-500/10' ?>" />
                                <?php if (isset($errors['slug'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['slug']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Nội dung bài viết <span class="text-error-500">*</span>
                                </label>
                                <textarea id="content" name="content" rows="8" placeholder="Nhập nội dung bài viết"
                                    class="h-auto w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10
                                    <?= isset($errors['content']) ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10' : '' ?>"><?= htmlspecialchars($content_old, ENT_QUOTES) ?></textarea>
                                <?php if (isset($errors['content'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['content']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
                            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                Cài đặt bài viết
                            </h3>
                        </div>
                        <div class="p-5 space-y-6 sm:p-6">

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Ảnh đại diện <span class="text-error-500">*</span>
                                </label>
                                <input type="file" name="cover_image" accept="image/*"
                                    class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400
                                    <?= isset($errors['cover_image']) ? 'border-error-500' : '' ?>" />
                                <?php if (isset($errors['cover_image'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['cover_image']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tác giả <span class="text-error-500">*</span>
                                </label>
                                <select name="author_id"
                                    class="h-11 w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:ring-brand-500/10
                                    <?= isset($errors['author_id']) ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10' : '' ?>">
                                    <option value="">-- Chọn tác giả --</option>
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id'] ?>" <?= ($author_id_old == $user['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($user['fullname'] ?? ($user['name'] ?? 'User #' . $user['id'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (isset($errors['author_id'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['author_id']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Trạng thái <span class="text-error-500">*</span>
                                </label>
                                <select id="status" name="status" 
                                    class="h-11 w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 focus:border-brand-300 focus:ring-brand-500/10
                                    <?= isset($errors['status']) ? 'border-error-500 text-error-500 focus:border-error-500 focus:ring-error-500/10' : '' ?>">
                                    <option value="">-- Chọn trạng thái --</option>
                                    <option value="1" <?= ($status_old == '1') ? 'selected' : '' ?>>Công bố</option>
                                    <option value="0" <?= ($status_old == '0') ? 'selected' : '' ?>>Nháp</option>
                                </select>
                                <?php if (isset($errors['status'])): ?>
                                    <p class="mt-1.5 text-xs text-error-500"><?= htmlspecialchars($errors['status']) ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 pt-6 dark:border-gray-800">
                <a href="admin.php?page=posts&action=index"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Hủy bỏ
                </a>
                <button type="submit" name="create"
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 flex h-11 items-center justify-center rounded-lg border border-transparent bg-success-500 px-4 py-2.5 text-sm font-medium text-white transition duration-300 ease-out hover:bg-success-600 dark:bg-success-600 dark:hover:bg-success-700">
                    Thêm bài viết
                </button>
            </div>
        </form>
        <?php
        unset($_SESSION['title_old'], $_SESSION['slug_old'], $_SESSION['content_old'], 
              $_SESSION['cover_image_old'], $_SESSION['author_id_old'], $_SESSION['status_old']);
        ?>
    </div>
</main>