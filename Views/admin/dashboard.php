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

<?php

if (!isset($formattedUsers))
    $formattedUsers = number_format(0);
if (!isset($formattedOrders))
    $formattedOrders = number_format(0);
?>
<main>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <div class="grid grid-cols-12 gap-4 md:gap-6">

            <div class="col-span-12 space-y-6">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6">

                    <div class="col-span-1 sm:col-span-1">
                        <div
                            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] md:p-8">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                                <svg class="fill-gray-800 dark:fill-white/90" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549ZM15.3042 11.4955C14.4702 11.4955 13.7006 11.2193 13.0821 10.7533C13.3742 10.3314 13.6054 9.86419 13.7632 9.36432C14.1597 9.75463 14.7039 9.99545 15.3042 9.99545C16.5176 9.99545 17.5012 9.01185 17.5012 7.79851C17.5012 6.58517 16.5176 5.60156 15.3042 5.60156C14.7039 5.60156 14.1597 5.84239 13.7632 6.23271C13.6054 5.73284 13.3741 5.26561 13.082 4.84371C13.7006 4.37777 14.4702 4.10156 15.3042 4.10156C17.346 4.10156 19.0012 5.75674 19.0012 7.79851C19.0012 9.84027 17.346 11.4955 15.3042 11.4955ZM19.9248 19.8987H16.3901C16.7014 19.4736 16.9159 18.969 16.9827 18.3987H19.9248C20.1341 18.3987 20.2991 18.3141 20.3936 18.2112C20.4796 18.1175 20.5169 18.0034 20.4837 17.861C20.2969 17.0607 19.913 16.088 19.1382 15.3208C18.4047 14.5945 17.261 13.9921 15.4231 13.9566C15.2232 13.6945 14.9995 13.437 14.7491 13.1891C14.5144 12.9566 14.262 12.7384 13.9916 12.5362C14.3853 12.4831 14.8044 12.4549 15.2503 12.4549C17.5447 12.4549 19.1291 13.2008 20.1936 14.2549C21.2395 15.2906 21.7206 16.5607 21.9444 17.5202C22.2657 18.8971 21.107 19.8987 19.9248 19.8987Z"
                                        fill="" />
                                </svg>
                            </div>

                            <div class="mt-5 flex items-end justify-between">
                                <div>
                                    <span class="text-lg text-gray-500 dark:text-gray-400">Khách hàng</span>
                                    <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                                        <?= $formattedUsers ?>
                                    </h4>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 sm:col-span-1">
                        <div
                            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] md:p-8">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                                <svg class="fill-gray-800 dark:fill-white/90" width="32" height="32" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                                        fill="" />
                                </svg>
                            </div>

                            <div class="mt-5 flex items-end justify-between">
                                <div>
                                    <span class="text-lg text-gray-500 dark:text-gray-400">Đơn hàng</span>
                                    <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                                        <?= $formattedOrders ?>
                                    </h4>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12">
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                Doanh số hàng tháng
                            </h3>

                            <div x-data="{openDropDown: false}" class="relative h-fit">
                                            <button @click="openDropDown = !openDropDown"
                                                :class="openDropDown ? 'text-gray-700 dark:text-white' : 'text-gray-400 hover:text-gray-700 dark:hover:text-white'">
                                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                                        fill="" />
                                                </svg>
                                            </button>
                                            <div x-show="openDropDown" @click.outside="openDropDown = false"
                                                class="absolute right-0 z-40 w-40 p-2 space-y-1 bg-white border border-gray-200 top-full rounded-2xl shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                                                <button
                                                    class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                                    Xem thêm
                                                </button>
                                                <button
                                                    class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                                    Xóa
                                                </button>
                                            </div>
                                        </div>
                        </div>

                        <div class="max-w-full overflow-x-auto custom-scrollbar">
                            <div class="-ml-5 min-w-[650px] pl-2 xl:min-w-full">
                                <canvas id="myChart" class="h-96 w-full"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-12">
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                    <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                Đơn hàng gần đây
                            </h3>
                        </div>

                        <div class="flex items-center gap-3">
                            <button
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                <svg class="stroke-current fill-white dark:fill-gray-800" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.29004 5.90393H17.7067" stroke="" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.7075 14.0961H2.29085" stroke="" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z"
                                        fill="" stroke="" stroke-width="1.5" />
                                    <path
                                        d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z"
                                        fill="" stroke="" stroke-width="1.5" />
                                </svg>

                                Lọc
                            </button>

                            <button
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                Xem tất cả
                            </button>
                        </div>
                    </div>

                    <div class="w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-gray-100 border-y dark:border-gray-800">
                                    <th class="py-3">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Sản phẩm
                                            </p>
                                        </div>
                                    </th>
                                    <th class="py-3">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Danh mục
                                            </p>
                                        </div>
                                    </th class="py-3">
                                    <th class="py-3">
                                        <div class="flex items-center">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Giá
                                            </p>
                                        </div>
                                    </th>
                                    <th class="py-3">
                                        <div class="flex items-center col-span-2">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                Trạng thái
                                            </p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                    <img src="Assets/admin/images/product/product-01.jpg"
                                                        alt="Product" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        Macbook pro 13”
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        2 Phiên bản
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                Laptop
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                59.975.000 VNĐ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p
                                                class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                                Đã giao
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                    <img src="Assets/admin/images/product/product-02.jpg"
                                                        alt="Product" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        Apple Watch Ultra
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        1 Phiên bản
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                Đồng hồ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                21.975.000 VNĐ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p
                                                class="rounded-full bg-warning-50 px-2 py-0.5 text-theme-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-orange-400">
                                                Đang chờ
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                    <img src="Assets/admin/images/product/product-03.jpg"
                                                        alt="Product" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        iPhone 15 Pro Max
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        2 Phiên bản
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                Điện thoại thông minh
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                46.725.000 VNĐ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p
                                                class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                                Đã giao
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                    <img src="Assets/admin/images/product/product-04.jpg"
                                                        alt="Product" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        iPad Pro Gen 3
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        2 Phiên bản
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                Điện tử
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                42.475.000 VNĐ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p
                                                class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                                Đã hủy
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                    <img src="Assets/admin/images/product/product-05.jpg"
                                                        alt="Product" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                        Airpods Pro Gen 2
                                                    </p>
                                                    <span class="text-gray-500 text-theme-xs dark:text-gray-400">
                                                        1 Phiên bản
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                Phụ kiện
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                6.000.000 VNĐ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <p
                                                class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                Đã giao
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Chart Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const labels = ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"];
    const data = <?= json_encode($finalData ?? []); ?>;

    console.log('Chart Data:', data);
    console.log('Canvas element:', document.getElementById('myChart'));

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng số đơn hàng theo tháng',
                data: data,
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(54,162,235,0.6)",
                borderColor: "rgba(255, 0, 200, 0.33)",
                borderWidth: 2
            }]

        },
        options: {
            legend: {
                display: true,
                labels: {
                    fontSize: 14
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0
                    }
                }]
            }
        }
    });
</script>