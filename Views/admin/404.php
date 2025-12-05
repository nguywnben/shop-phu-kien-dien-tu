<?php
require_once "header.php";
require_once "layouts/sidebar.php";
?>

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            <?php require_once "layouts/header.php"; ?>

            <main class="p-6 w-full">
                <div class="mx-auto max-w-3xl">
                    <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center dark:border-gray-800 dark:bg-white/[0.03]">
                        <h1 class="text-6xl font-extrabold text-gray-800 dark:text-white/90">404</h1>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Không tìm thấy trang bạn yêu cầu.</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">URL có thể sai hoặc nội dung đã bị xóa.</p>
                        <div class="mt-6 flex items-center justify-center gap-3">
                            <a href="admin.php" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">Trang chủ</a>
                            <a href="admin.php?page=products&action=index" class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white">Danh sách sản phẩm</a>
                        </div>
                    </div>
                </div>
            </main>

<?php
require_once "footer.php";

