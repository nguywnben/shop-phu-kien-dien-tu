<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="Assets/admin/images/logo/logo.svg" alt="Logo" />
                <img class="hidden dark:block" src="Assets/admin/images/logo/logo-dark.svg" alt="Logo" />
            </span>

            <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="Assets/admin/images/logo/logo-icon.svg" alt="Logo" />
        </a>
    </div>
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav x-data="{selected: $persist('Dashboard')}">
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    <li>
                        <a href="index.php" @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            class="menu-item group"
                            :class=" (selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' || page === 'marketing' || page === 'crm' || page === 'stocks') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' || page === 'marketing' || page === 'crm' || page === 'stocks') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                    fill="" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Bảng điều khiển
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Categories' ? '':'Categories')"
                            class="menu-item group"
                            :class=" (selected === 'Categories') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Categories') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4H10L12 6H20C21.1046 6 22 6.89543 22 8V18C22 19.1046 21.1046 20 20 20H10Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Danh mục
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Categories') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Categories') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="category.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách danh mục
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Categories') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="category-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm danh mục
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Products' ? '':'Products')"
                            class="menu-item group"
                            :class=" (selected === 'Products') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Products') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.75 4C6.50736 4 5.5 5.00736 5.5 6.25V17.75C5.5 18.9926 6.50736 20 7.75 20H16.25C17.4926 20 18.5 18.9926 18.5 17.75V6.25C18.5 5.00736 17.4926 4 16.25 4H7.75ZM5.5 8.75H18.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Sản phẩm
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Products') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Products') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="product.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Products') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="product-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Orders' ? '':'Orders')"
                            class="menu-item group"
                            :class=" (selected === 'Orders') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Orders') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 2L3 6V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V6L18 2H6Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M3 6H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 10C15 11.6569 13.6569 13 12 13C10.3431 13 9 11.6569 9 10"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Đơn hàng
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Orders') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Orders') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="order.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách đơn hàng
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Orders') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="order-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm đơn hàng
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Coupons' ? '':'Coupons')"
                            class="menu-item group"
                            :class=" (selected === 'Coupons') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Coupons') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 9L9 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 9H9.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 15H15.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Mã giảm
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Coupons') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Coupons') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="coupon.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách mã giảm
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Coupons') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="coupon-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm mã giảm
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="user.php" @click="selected = (selected === 'Users' ? '':'Users')"
                            class="menu-item group"
                            :class=" (selected === 'Users') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Users') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Người dùng
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Brands' ? '':'Brands')"
                            class="menu-item group"
                            :class=" (selected === 'Brands') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Brands') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 7.5V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 7.5L4.5 11.75" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 7.5L19.5 11.75" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Thương hiệu
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Brands') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Brands') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="brand.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách thương hiệu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Brands') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="brand-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm thương hiệu
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Blogs' ? '':'Blogs')"
                            class="menu-item group"
                            :class=" (selected === 'Blogs') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Blogs') || (page === 'formElements' || page === 'formLayout' || page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 20H20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M16 13L20.5 8.5C21.3284 7.67157 21.3284 6.32843 20.5 5.5C19.6716 4.67157 18.3284 4.67157 17.5 5.5L13 10L13 14H17L17 13Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M3.5 21C3.5 19.8954 4.39543 19 5.5 19H9" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.5 3C3.5 4.10457 4.39543 5 5.5 5H9" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.5 12C3.5 13.1046 4.39543 14 5.5 14H7" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Bài viết
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Blogs') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Blogs') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="blog.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Danh sách bài viết
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Blogs') ? 'block' :'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="blog-add.php" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                        Thêm bài viết
                                    </a>
                                </li>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>