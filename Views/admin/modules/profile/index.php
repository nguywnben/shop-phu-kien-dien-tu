<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
    <div x-data="{ open: true }" x-show="open"
        class="rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15 mb-4 relative">

        <div class="flex items-start gap-3 mr-6">
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

        <div class="flex items-start gap-3 mr-6">
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
        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-user-circle mr-2"></i> Hồ sơ cá nhân
        </h2>

        <div class="grid grid-cols-12 gap-4 md:gap-6">

            <div class="col-span-12 lg:col-span-4">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] shadow-theme-lg">

                    <div
                        class="flex flex-col items-center justify-center mb-6 border-b border-gray-100 dark:border-gray-800 pb-6">

                        <div
                            class="relative h-24 w-24 rounded-full overflow-hidden border-4 border-white dark:border-gray-900 shadow-lg group">
                            <img src="<?php echo $user['avatar'] ?? 'Assets/admin/images/user/default.png'; ?> "
                                style="width:80px;" alt="Ảnh đại diện" class="object-cover h-full w-full">
                            <form id="avatarForm" action="?page=profile&action=update" method="POST"
                                enctype="multipart/form-data" style="display:none;">
                                <input type="file" name="avatar" id="avatarInput" accept="image/*"
                                    onchange="document.getElementById('avatarForm').submit();">
                            </form>
                            <button type="button" title="Thay đổi ảnh"
                                class="absolute bottom-0 right-0 p-1 bg-brand-500 rounded-full text-white hover:bg-brand-600 transition-colors shadow-md"
                                onclick="document.getElementById('avatarInput').click();">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.995a2 2 0 001.65-.773l1.826-2.435A2 2 0 0110.669 3h2.662a2 2 0 011.65.773l1.826 2.435A2 2 0 0017.005 7H18a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>

                        <h3 class="mt-3 text-lg font-bold text-gray-800 dark:text-white/90">
                            <?php echo $user['name'] ?? 'Tên người dùng'; ?>
                        </h3>

                        <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                            <?php
                            echo ($user['role'] == 1) ? 'Quản trị viên' : 'Người dùng';
                            ?>
                        </p>

                        <p
                            class="text-theme-xs mt-1 
                            <?php echo ($user['status'] == 1) ? 'text-success-600 dark:text-success-500' : 'text-error-600 dark:text-error-500'; ?>">
                            Trạng thái:
                            <?php
                            echo ($user['status'] == 1) ? 'Đang hoạt động' : 'Không hoạt động';
                            ?>
                        </p>
                    </div>

                    <nav class="space-y-1">
                        <a href="#"
                            class="flex items-center gap-3 p-3 rounded-lg bg-gray-100 text-gray-900 font-medium dark:bg-white/5 dark:text-white/90 shadow-theme-xs">
                            <i class="fas fa-cog w-5 h-5"></i> Cài đặt chung
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white/90">
                            <i class="fas fa-lock w-5 h-5"></i> Bảo mật & Mật khẩu
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white/90">
                            <i class="fas fa-bell w-5 h-5"></i> Cài đặt thông báo
                        </a>
                    </nav>

                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] shadow-theme-lg">
                    <h3 class="mb-5 text-xl font-bold text-gray-900 dark:text-white">
                        Cập nhật thông tin cá nhân
                    </h3>

                    <form action="?page=profile&action=update" method="POST" class="space-y-6"
                        enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $userData['id'] ?? ''; ?>">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tên đầy
                                    đủ</label>
                                <input type="text" id="name" name="name" placeholder="Nhập tên đầy đủ"
                                    class="w-full rounded-lg border border-gray-200 bg-white py-2.5 px-4 text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:focus:border-brand-400"
                                    value="<?php echo $userData['name'] ?? ''; ?>">
                            </div>
                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Vai
                                    trò</label>
                                <input type="text" id="role" name="role"
                                    class="bg-gray-100 cursor-not-allowed dark:bg-gray-800 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-500 focus:outline-none dark:border-gray-700 dark:text-gray-400"
                                    value="<?php echo ($user['role'] == 1) ? 'Quản trị viên' : 'Người dùng'; ?>"
                                    disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Địa chỉ
                                    Email</label>
                                <input type="email" id="email" name="email" placeholder="example@email.com"
                                    class="w-full rounded-lg border border-gray-200 bg-white py-2.5 px-4 text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:focus:border-brand-400"
                                    value="<?php echo $user['email'] ?? ''; ?>">
                            </div>
                            <div>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Số điện
                                    thoại</label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full rounded-lg border border-gray-200 bg-white py-2.5 px-4 text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:focus:border-brand-400"
                                    value="<?php echo $user['phone'] ?? 'Chưa có số điện thoại'; ?>">
                            </div>
                        </div>



                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                            <a href="admin.php"
                                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                                Hủy bỏ
                            </a>
                            <button type="submit"
                                class="inline-flex items-center rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-sm hover:bg-brand-600 transition-colors">
                                <i class="fas fa-save mr-2"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>