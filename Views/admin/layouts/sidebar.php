<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="admin.php">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="Assets/admin/images/logo/logo.png" alt="Logo" />
                <img class="hidden dark:block" src="Assets/admin/images/logo/logo.png" alt="Logo" />
            </span>

            <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="Assets/admin/images/logo/logo.png" alt="Logo" />
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
                        class="mx-auto menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            stroke="currentColor" stroke-width="1.5"/> </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    <li>
                        <a href="admin.php" @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            class="menu-item group"
                            :class=" (selected === 'Dashboard') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Dashboard') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3.25" y="3.25" width="7.5" height="7.5" rx="1.25" stroke="currentColor" stroke-width="1.5" />
                                <rect x="13.25" y="3.25" width="7.5" height="7.5" rx="1.25" stroke="currentColor" stroke-width="1.5" />
                                <rect x="3.25" y="13.25" width="7.5" height="7.5" rx="1.25" stroke="currentColor" stroke-width="1.5" />
                                <rect x="13.25" y="13.25" width="7.5" height="7.5" rx="1.25" stroke="currentColor" stroke-width="1.5" />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Bảng điều khiển
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=categories&action=index" @click="selected = (selected === 'Categories' ? '':'Categories')"
                            class="menu-item group"
                            :class=" (selected === 'Categories') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Categories') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 4C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4H5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4 10H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Danh mục
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=products&action=index" @click="selected = (selected === 'Products' ? '':'Products')"
                            class="menu-item group"
                            :class=" (selected === 'Products') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Products') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 3L2 9L12 15L22 9L12 3Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 15L12 21L22 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 9V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 9V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Sản phẩm
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=orders&action=index" @click="selected = (selected === 'Orders' ? '':'Orders')"
                            class="menu-item group"
                            :class=" (selected === 'Orders') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Orders') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 2L3 6V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V6L18 2H6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 6H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 10C16 11.0609 15.5786 12.0783 14.8284 12.8284C14.0783 13.5786 13.0609 14 12 14C10.9391 14 9.92172 13.5786 9.17157 12.8284C8.42143 12.0783 8 11.0609 8 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Đơn hàng
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=coupons&action=index" @click="selected = (selected === 'Coupons' ? '':'Coupons')"
                            class="menu-item group"
                            :class=" (selected === 'Coupons') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Coupons') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 12.5V5.5C20.5 5.03579 20.3156 4.59013 19.9882 4.26275C19.6609 3.93538 19.2152 3.75 18.75 3.75H5.25C4.78478 3.75 4.33913 3.93538 4.01175 4.26275C3.68437 4.59013 3.5 5.03579 3.5 5.5V18.5C3.5 18.9642 3.68437 19.4099 4.01175 19.7373C4.33913 20.0647 4.78478 20.25 5.25 20.25H12.5L20.5 12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="8" cy="8" r="1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.5 9L18 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Mã giảm giá
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=users&action=index" @click="selected = (selected === 'Users' ? '':'Users')"
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
                        <a href="admin.php?page=brands&action=index" @click="selected = (selected === 'Brands' ? '':'Brands')"
                            class="menu-item group"
                            :class=" (selected === 'Brands') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Brands') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 4.5L13.5 11.5L4 11.5L4 20.5L11.5 20.5L20.5 11.5L20.5 4.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="8" cy="8" r="1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Thương hiệu
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?page=posts&action=index" @click="selected = (selected === 'Blogs' ? '':'Blogs')"
                            class="menu-item group"
                            :class=" (selected === 'Blogs') ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Blogs') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8.5L14.5 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 15H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 11H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Bài viết
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>