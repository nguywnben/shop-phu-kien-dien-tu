<?php
// Lấy biến lỗi và dữ liệu cũ từ phiên (session)
// Biến này được BrandController::store() thiết lập nếu validation thất bại
$name_error = $_SESSION['name_error'] ?? "";
$slug_error = $_SESSION['slug_error'] ?? "";
$status_error = $_SESSION['status_error'] ?? "";
$logo_error = $_SESSION['logo_error'] ?? "";

// Biến lưu trữ giá trị cũ (old input)
$name_value = $_SESSION['name_old'] ?? '';
$slug_value = $_SESSION['slug_old'] ?? '';
// Mặc định trạng thái là '1' (Hiển thị) nếu không có dữ liệu cũ từ session
$status_value = $_SESSION['status_old'] ?? '1';

?>
<main>
  <div class="mx-auto max-w-4xl p-4 md:p-6">
    <div x-data="{ pageName: 'Thêm Thương hiệu mới'}">
      <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

        <nav>
          <ol class="flex items-center gap-1.5">
            <li>
              <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400" href="index.html">
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
                href="?page=brands&action=index">
                Danh sách Thương hiệu
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
      <div class="rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15 mb-4">
        <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['error']) ?></p>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
      <div
        class="rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15 mb-4">
        <p class="text-sm text-gray-500 dark:text-gray-400"><?= htmlspecialchars($_SESSION['success']) ?></p>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form id="add-brand" method="POST" action="?page=brands&action=store" enctype="multipart/form-data">

      <div class="grid grid-cols-1 gap-6">

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
          <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:px-6 sm:py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Thông tin cơ bản và Trạng thái</h3>
          </div>

          <div class="p-5 space-y-6 sm:p-6">
            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tên
                thương hiệu <span class="text-error-500">*</span></label>
              <input type="text" name="name" id="brandName"
                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                placeholder="Nhập tên thương hiệu" value="<?= htmlspecialchars($name_value) ?>" />
              <?php if ($name_error): ?>
                <p class="mt-1 text-sm text-error-500"><?= $name_error ?></p>
              <?php endif; ?>
            </div>

            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">URL
                thân thiện (Slug) <span class="text-error-500">*</span></label>
              <input type="text" name="slug" id="brandSlug"
                class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800"
                placeholder="Ví dụ: ten-thuong-hieu" value="<?= htmlspecialchars($slug_value) ?>" />
              <?php if ($slug_error): ?>
                <p class="mt-1 text-sm text-error-500"><?= $slug_error ?></p>
              <?php endif; ?>
            </div>

            <div>
              <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Trạng
                thái hiển thị <span class="text-error-500">*</span></label>
              <div class="relative z-20 bg-transparent">
                <select id="status" name="status"
                  class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800">
                  <option value="1" <?= ($status_value == '1') ? 'selected' : '' ?>>
                    1: Hiển thị
                  </option>
                  <option value="0" <?= ($status_value == '0') ? 'selected' : '' ?>>
                    0: Ẩn
                  </option>
                </select>
              </div>
              <?php if ($status_error): ?>
                <p class="mt-1 text-sm text-error-500"><?= $status_error ?></p>
              <?php endif; ?>
            </div>

            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Logo
                thương hiệu <span class="text-error-500">*</span></label>

              <input type="file" name="logo" id="brandLogo" accept="image/*"
                class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />

              <?php if ($logo_error): ?>
                <p class="mt-1 text-sm text-error-500"><?= $logo_error ?></p>
              <?php endif; ?>
            </div>

          </div>
          <div class="flex items-center justify-end gap-3 mt-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <a href="?page=brands&action=index"
              class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700">Hủy
              bỏ</a>
            <button type="submit" name="btn_add"
              class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 flex h-11 items-center justify-center rounded-lg border border-transparent bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition duration-300 ease-out hover:bg-brand-600 dark:bg-brand-600 dark:hover:bg-brand-700">Thêm
              thương hiệu</button>
          </div>
        </div>
      </div>


    </form>

    <?php
    // Xóa session dữ liệu cũ và lỗi sau khi render
    unset(
      $_SESSION['name_old'],
      $_SESSION['slug_old'],
      $_SESSION['status_old'],
      $_SESSION['name_error'],
      $_SESSION['slug_error'],
      $_SESSION['status_error'],
      $_SESSION['logo_error']
    );
    ?>
  </div>
</main>