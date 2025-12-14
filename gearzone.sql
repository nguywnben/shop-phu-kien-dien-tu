-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 14, 2025 lúc 07:36 AM
-- Phiên bản máy phục vụ: 8.0.39
-- Phiên bản PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gearzone`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Liên kết với bảng users',
  `recipient_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tỉnh/Thành phố',
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Quận/Huyện',
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Phường/Xã',
  `address_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Số nhà, tên đường',
  `is_default` tinyint DEFAULT '0' COMMENT '1: Mặc định, 0: Phụ',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `recipient_name`, `phone`, `province`, `district`, `ward`, `address_line`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nguyen Van A', '0901234567', 'Hà Nội', 'Quận Cầu Giấy', 'Phường Dịch Vọng', 'Số 12, Ngõ 34 Đường Xuân Thủy', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(2, 2, 'Tran Thi B', '0912345678', 'TP. Hồ Chí Minh', 'Quận 1', 'Phường Bến Nghé', 'Tòa nhà Bitexco, số 2 Hải Triều', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(3, 3, 'Le Van C', '0923456789', 'Đà Nẵng', 'Quận Hải Châu', 'Phường Thạch Thang', '15 Đường Lê Duẩn', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(4, 4, 'Pham Minh D', '0934567890', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Tân An', '88 Đường Hai Bà Trưng', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(5, 5, 'Hoang Thi E', '0945678901', 'Hải Phòng', 'Quận Ngô Quyền', 'Phường Lạch Tray', '102 Đường Lạch Tray', 0, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(6, 6, 'Doan Van F', '0956789012', 'Đồng Nai', 'TP. Biên Hòa', 'Phường Tam Hiệp', 'Khu phố 1, Đường Phạm Văn Thuận', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(7, 7, 'Vo Thi G', '0967890123', 'Bình Dương', 'TP. Thủ Dầu Một', 'Phường Phú Hòa', '20 Đại lộ Bình Dương', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(8, 8, 'Bui Van H', '0978901234', 'Khánh Hòa', 'TP. Nha Trang', 'Phường Lộc Thọ', 'Trần Phú, Vincom Plaza', 0, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(9, 9, 'Dang Thi I', '0989012345', 'Thừa Thiên Huế', 'TP. Huế', 'Phường Vĩnh Ninh', 'Số 5 Đống Đa', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14'),
(10, 10, 'Ngo Van K', '0990123456', 'Quảng Ninh', 'TP. Hạ Long', 'Phường Bãi Cháy', 'Khu du lịch Bãi Cháy', 1, '2025-11-24 01:03:14', '2025-11-24 01:03:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiêu đề bài viết',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Đường dẫn thân thiện (SEO)',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Nội dung bài viết',
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ảnh đại diện bài viết',
  `author_id` int NOT NULL COMMENT 'Người viết (User ID)',
  `status` tinyint DEFAULT '1' COMMENT '1: Xuất bản, 0: Bản nháp',
  `published_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian công khai',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `content`, `cover_image`, `author_id`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Top 5 sạc dự phòng đáng mua nhất cho dân phượt 2025', 'top-5-sac-du-phong-phuot-2025', 'Nội dung đánh giá chi tiết sạc Xiaomi, Anker...', 'uploads/blog/top-powerbank.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(2, 'Công nghệ GaN là gì? Tại sao củ sạc ngày càng nhỏ gọn?', 'cong-nghe-gan-la-gi', 'Giải thích về Gallium Nitride trong củ sạc...', 'uploads/blog/what-is-gan.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(3, 'Hướng dẫn phân biệt cáp sạc iPhone chính hãng và hàng Fake', 'phan-biet-cap-iphone-fake-real', 'Các dấu hiệu nhận biết qua chân tiếp xúc, chữ in...', 'uploads/blog/iphone-cable-check.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(4, 'Review chi tiết tai nghe Sony WH-1000XM5 sau 1 tháng sử dụng', 'review-sony-wh-1000xm5', 'Đánh giá khả năng chống ồn, chất âm...', 'uploads/blog/review-sony-xm5.jpg', 2, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(5, 'Nên dùng ốp lưng cứng hay ốp lưng dẻo cho điện thoại?', 'so-sanh-op-cung-va-op-deo', 'Ưu nhược điểm của từng loại chất liệu...', 'uploads/blog/case-comparison.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(6, 'Cách vệ sinh tai nghe Bluetooth đúng cách để tránh hỏng hóc', 'huong-dan-ve-sinh-tai-nghe', 'Sử dụng cồn, tăm bông để làm sạch...', 'uploads/blog/clean-earbuds.jpg', 2, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(7, 'Chuột công thái học (Ergonomic) có thực sự giảm đau cổ tay?', 'loi-ich-chuot-cong-thai-hoc', 'Phân tích về thiết kế Vertical Mouse của Logitech...', 'uploads/blog/ergonomic-mouse.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(8, 'Tìm hiểu về chuẩn sạc nhanh PD (Power Delivery) và QC 3.0', 'tim-hieu-sac-nhanh-pd-qc', 'Sự khác biệt giữa các công nghệ sạc...', 'uploads/blog/pd-vs-qc.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(9, 'Tổng hợp các mẫu loa Bluetooth chống nước tốt nhất cho tiệc bể bơi', 'loa-bluetooth-chong-nuoc-tot', 'Danh sách loa JBL, Sony kháng nước IP67...', 'uploads/blog/waterproof-speakers.jpg', 2, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52'),
(10, 'Lịch nghỉ Tết và chương trình khuyến mãi đầu xuân 2025', 'lich-nghi-tet-2025', 'Thông báo thời gian giao hàng dịp Tết...', 'uploads/blog/tet-notification.jpg', 1, 1, '2025-11-24 01:29:52', '2025-11-24 01:29:52', '2025-11-24 01:29:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên thương hiệu',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'URL thân thiện (SEO)',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn ảnh logo',
  `status` tinyint DEFAULT '1' COMMENT '1: Hiển thị, 0: Ẩn',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anker', 'anker', 'uploads/brands/anker.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(2, 'Baseus', 'baseus', 'uploads/brands/baseus.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(3, 'Logitech', 'logitech', 'uploads/brands/logitech.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(4, 'Samsung', 'samsung', 'uploads/brands/samsung.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(5, 'Apple', 'apple', 'uploads/brands/apple.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(6, 'JBL', 'jbl', 'uploads/brands/jbl.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(7, 'Xiaomi', 'xiaomi', 'uploads/brands/xiaomi.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(8, 'Remax', 'remax', 'uploads/brands/remax.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(9, 'Hoco', 'hoco', 'uploads/brands/hoco.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49'),
(10, 'Sony', 'sony', 'uploads/brands/sony.png', 1, '2025-11-24 01:09:49', '2025-11-24 01:09:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Khách hàng sở hữu giỏ hàng',
  `product_id` int NOT NULL COMMENT 'Sản phẩm được chọn',
  `variant_id` int DEFAULT NULL COMMENT 'Biến thể sản phẩm (Màu/Size). NULL nếu sp không có biến thể',
  `qty` int NOT NULL DEFAULT '1' COMMENT 'Số lượng mua',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `variant_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(2, 1, 2, 5, 2, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(3, 2, 7, 3, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(4, 3, 4, 7, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(5, 4, 1, 9, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(6, 5, 3, 2, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(7, 6, 2, 6, 5, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(8, 7, 4, 8, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(9, 8, 7, 4, 1, '2025-11-24 01:25:06', '2025-11-24 01:25:06'),
(10, 9, 1, 10, 2, '2025-11-24 01:25:06', '2025-11-24 01:25:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `parent_id` int DEFAULT NULL COMMENT 'ID danh mục cha (NULL nếu là danh mục gốc)',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên danh mục',
  `level` tinyint DEFAULT '0' COMMENT '0: Root, 1: Sub-category, ...',
  `status` tinyint DEFAULT '1' COMMENT '1: Hiển thị, 0: Ẩn',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `level`, `status`, `create_at`, `update_at`, `image`) VALUES
(1, NULL, 'Phụ kiện Điện thoại', 0, 1, '2025-11-24 01:08:10', '2025-11-26 08:18:38', 'phukiendienthoai.webp'),
(2, NULL, 'Phụ kiện Máy tính / Laptop', 0, 1, '2025-11-24 01:08:10', '2025-11-26 08:18:47', 'phukienmaytinh.webp'),
(3, NULL, 'Thiết bị Âm thanh', 0, 1, '2025-11-24 01:08:10', '2025-11-26 08:24:12', 'pinduphong.webp'),
(4, 1, 'Ốp lưng & Bao da', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:19:45', 'oplungbaoda.webp'),
(5, 1, 'Cáp sạc & Củ sạc', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:19:58', 'cocsacdaysac.webp'),
(6, 1, 'Kính cường lực', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:20:07', 'kinhcuongluc.webp'),
(7, 1, 'Pin dự phòng', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:20:28', 'pinduphong.webp'),
(8, 2, 'Chuột & Bàn phím', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:20:42', 'phukienmaytinh.webp'),
(9, 2, 'USB & Ổ cứng di động', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:07:23', 'usb.webp'),
(10, 3, 'Tai nghe Bluetooth', 1, 1, '2025-11-24 01:08:10', '2025-11-26 08:23:26', 'tainghe.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` int NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã giảm giá (VD: SALE50)',
  `max_discount` int DEFAULT '0' COMMENT 'Số tiền giảm tối đa',
  `min_order_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Giá trị đơn tối thiểu để áp dụng',
  `usage_limit` int DEFAULT '0' COMMENT 'Giới hạn số lần sử dụng',
  `used_count` int DEFAULT '0' COMMENT 'Số lần đã dùng',
  `start_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian bắt đầu',
  `end_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian kết thúc',
  `status` tinyint DEFAULT '1' COMMENT '1: Hoạt động, 0: Hết hạn/Vô hiệu',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `max_discount`, `min_order_total`, `usage_limit`, `used_count`, `start_at`, `end_at`, `status`, `updated_at`) VALUES
(1, 'WELCOME', 50000, '200000', 1000, 150, '2025-11-24 01:23:46', '2025-12-24 01:23:46', 1, '2025-11-24 01:23:46'),
(2, 'FREESHIP', 30000, '150000', 500, 420, '2025-11-24 01:23:46', '2026-11-24 01:23:46', 1, '2025-11-24 01:23:46'),
(3, 'PHUKIEN10', 20000, '100000', 200, 10, '2025-11-24 01:23:46', '2025-12-01 01:23:46', 1, '2025-11-24 01:23:46'),
(4, 'BLACKFRIDAY', 100000, '1000000', 100, 0, '2025-11-19 17:00:00', '2025-11-30 16:59:59', 0, '2025-11-24 01:23:46'),
(5, 'TET2025', 202500, '2000000', 50, 5, '2024-12-31 17:00:00', '2025-02-15 16:59:59', 1, '2025-11-24 01:23:46'),
(6, 'ANKERVIP', 50000, '500000', 500, 23, '2025-11-24 01:23:46', '2026-01-23 01:23:46', 1, '2025-11-24 01:23:46'),
(7, 'HOCOFAN', 15000, '50000', 1000, 890, '2025-11-24 01:23:46', '2025-12-24 01:23:46', 1, '2025-11-24 01:23:46'),
(8, 'SALEHE', 25000, '250000', 300, 300, '2025-09-24 01:23:46', '2025-10-24 01:23:46', 0, '2025-11-24 01:23:46'),
(9, 'HOANHTRANG', 500000, '5000000', 10, 2, '2025-11-24 01:23:46', '2025-11-29 01:23:46', 1, '2025-11-24 01:23:46'),
(10, 'KHACHMOI', 20000, '0', 2000, 100, '2025-11-24 01:23:46', '2026-02-22 01:23:46', 1, '2025-11-24 01:23:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Khách hàng đặt đơn',
  `status` tinyint DEFAULT '1' COMMENT '1: Chờ xác nhận, 2: Đang xử lý, 3: Đang giao, 4: Hoàn thành, 5: Hủy',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Tổng tiền hàng',
  `discount_total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Tổng tiền giảm giá',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Phí vận chuyển',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Tổng thanh toán cuối cùng',
  `payment_status` tinyint DEFAULT '0' COMMENT '0: Chưa thanh toán, 1: Đã thanh toán',
  `shipping_status` tinyint DEFAULT '0' COMMENT '0: Chưa giao, 1: Đang giao, 2: Đã giao',
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ghi chú của khách hàng',
  `recipient_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên người nhận',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'SĐT người nhận',
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `canceled_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian hủy đơn (nếu có)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `subtotal`, `discount_total`, `shipping_fee`, `grand_total`, `payment_status`, `shipping_status`, `note`, `recipient_name`, `phone`, `province`, `district`, `ward`, `address_line`, `created_at`, `updated_at`, `canceled_at`) VALUES
(1, 1, 4, 6990000.00, 50000.00, 0.00, 6940000.00, 1, 2, 'Giao giờ hành chính', 'Nguyen Van A', '0901234567', 'Hà Nội', 'Quận Cầu Giấy', 'Phường Dịch Vọng', 'Số 12, Ngõ 34', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(2, 2, 3, 470000.00, 20000.00, 30000.00, 480000.00, 1, 1, NULL, 'Tran Thi B', '0912345678', 'Hồ Chí Minh', 'Quận 1', 'Phường Bến Nghé', 'Tòa nhà Bitexco', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(3, 3, 1, 1100000.00, 0.00, 30000.00, 1130000.00, 0, 0, 'Gọi trước khi giao', 'Le Van C', '0923456789', 'Đà Nẵng', 'Quận Hải Châu', 'Phường Thạch Thang', '15 Lê Duẩn', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(4, 4, 5, 2190000.00, 0.00, 0.00, 2190000.00, 0, 0, NULL, 'Pham Minh D', '0934567890', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Tân An', '88 Hai Bà Trưng', '2025-11-24 01:27:54', '2025-11-24 01:27:54', '2025-11-24 01:27:54'),
(5, 5, 2, 590000.00, 50000.00, 15000.00, 555000.00, 1, 0, NULL, 'Hoang Thi E', '0945678901', 'Hải Phòng', 'Quận Ngô Quyền', 'Phường Lạch Tray', '102 Lạch Tray', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(6, 6, 4, 2190000.00, 100000.00, 0.00, 2090000.00, 1, 2, 'Gửi bảo vệ nhận giúp', 'Doan Van F', '0956789012', 'Đồng Nai', 'TP. Biên Hòa', 'Phường Tam Hiệp', 'Khu phố 1', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(7, 7, 3, 4500000.00, 200000.00, 50000.00, 4350000.00, 0, 1, NULL, 'Vo Thi G', '0967890123', 'Bình Dương', 'TP. Thủ Dầu Một', 'Phường Phú Hòa', '20 Đại lộ Bình Dương', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(8, 8, 1, 90000.00, 0.00, 25000.00, 115000.00, 0, 0, NULL, 'Bui Van H', '0978901234', 'Khánh Hòa', 'TP. Nha Trang', 'Phường Lộc Thọ', '78 Trần Phú', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL),
(9, 9, 5, 350000.00, 0.00, 15000.00, 365000.00, 1, 0, 'Shop báo hết màu tím', 'Dang Thi I', '0989012345', 'Huế', 'TP. Huế', 'Phường Vĩnh Ninh', 'Số 5 Đống Đa', '2025-11-24 01:27:54', '2025-11-24 01:27:54', '2025-11-24 01:27:54'),
(10, 10, 4, 150000.00, 10000.00, 20000.00, 160000.00, 1, 2, NULL, 'Ngo Van K', '0990123456', 'Quảng Ninh', 'TP. Hạ Long', 'Phường Bãi Cháy', 'Khu du lịch Bãi Cháy', '2025-11-24 01:27:54', '2025-11-24 01:27:54', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL COMMENT 'Thuộc về đơn hàng nào',
  `product_id` int DEFAULT NULL COMMENT 'Sản phẩm nào (Cho phép NULL nếu sản phẩm bị xóa)',
  `variant_id` int DEFAULT NULL COMMENT 'Biến thể (Màu/Size). NULL nếu sp không có biến thể',
  `sku_snapshot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Lưu cứng mã SKU tại thời điểm mua',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Giá bán tại thời điểm mua',
  `qty` int NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  `line_total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Thành tiền = price * qty',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `sku_snapshot`, `unit_price`, `qty`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 3, 'SON-XM5-BK', 6990000.00, 1, 6990000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(2, 2, 1, 9, 'ANK-30W-VT', 350000.00, 1, 350000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(3, 2, 2, 5, 'BAS-CBL-WH', 120000.00, 1, 120000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(4, 3, 4, 7, 'APP-CASE-CLR', 1100000.00, 1, 1100000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(5, 4, 3, 1, 'LOG-MX3S-GR', 2190000.00, 1, 2190000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(6, 5, 5, NULL, 'XIA-PB-20K', 590000.00, 1, 590000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(7, 6, 3, 2, 'LOG-MX3S-PG', 2190000.00, 1, 2190000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(8, 7, 6, NULL, 'JBL-TOUR-2', 4500000.00, 1, 4500000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(9, 8, 8, NULL, 'REM-GL27', 90000.00, 1, 90000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(10, 9, 1, 10, 'ANK-30W-BL', 350000.00, 1, 350000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58'),
(11, 10, 9, NULL, 'HOC-CA80', 150000.00, 1, 150000.00, '2025-11-24 01:28:58', '2025-11-24 01:28:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL COMMENT 'Thời gian hết hạn của token',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`, `created_at`) VALUES
(1, 'vana.nguyen@example.com', 'a1b2c3d4e5f678901234567890abcdef', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(2, 'thib.tran@example.com', 'b2c3d4e5f678901234567890abcdefa1', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(3, 'vanc.le@example.com', 'c3d4e5f678901234567890abcdefa1b2', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(4, 'minhd.pham@example.com', 'd4e5f678901234567890abcdefa1b2c3', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(5, 'thie.hoang@example.com', 'e5f678901234567890abcdefa1b2c3d4', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(6, 'vanf.doan@example.com', 'f678901234567890abcdefa1b2c3d4e5', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(7, 'thig.vo@example.com', '78901234567890abcdefa1b2c3d4e5f6', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(8, 'vanh.bui@example.com', '8901234567890abcdefa1b2c3d4e5f67', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(9, 'thii.dang@example.com', '901234567890abcdefa1b2c3d4e5f678', '2025-11-24 01:21:46', '2025-11-24 01:06:46'),
(10, 'vank.ngo@example.com', '01234567890abcdefa1b2c3d4e5f6789', '2025-11-24 01:21:46', '2025-11-24 01:06:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `brand_id` int NOT NULL COMMENT 'Liên kết với bảng brands',
  `category_id` int NOT NULL COMMENT 'Liên kết với bảng categories',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `sku_model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã SKU hoặc Model sản phẩm',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Mô tả ngắn',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Nội dung chi tiết sản phẩm',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Giá bán',
  `status` tinyint DEFAULT '1' COMMENT '1: Đang bán, 0: Ngừng kinh doanh',
  `rating_count` int DEFAULT '0' COMMENT 'Số lượt đánh giá',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `sku_model`, `description`, `content`, `price`, `status`, `rating_count`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Củ sạc nhanh Anker Nano III 30W', 'ANK-30W-01', 'Sạc siêu nhỏ gọn cho iPhone 14/15', 'Chi tiết về công nghệ GaN...', 350000.00, 1, 150, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(2, 2, 5, 'Cáp sạc Baseus Crystal Shine USB-C to Lightning', 'BAS-CBL-02', 'Cáp bọc dù siêu bền, dài 1.2m', 'Hỗ trợ sạc nhanh PD 20W...', 120000.00, 1, 89, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(3, 3, 8, 'Chuột không dây Logitech MX Master 3S', 'LOG-MX3S', 'Chuột công thái học cao cấp', 'Cảm biến 8000 DPI, cuộn vô cực...', 2190000.00, 1, 342, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(4, 5, 4, 'Ốp lưng MagSafe iPhone 15 Pro Max', 'APP-CASE-15PM', 'Ốp lưng nhựa trong suốt chính hãng', 'Hỗ trợ sạc không dây MagSafe...', 1100000.00, 1, 56, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(5, 7, 7, 'Sạc dự phòng Xiaomi Gen 3 20000mAh', 'XIA-PB-20K', 'Sạc nhanh 2 chiều 18W', 'Dung lượng lớn, sạc được laptop...', 590000.00, 1, 210, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(6, 6, 10, 'Tai nghe Bluetooth JBL Tour Pro 2', 'JBL-TOUR-2', 'Tai nghe chống ồn chủ động', 'Màn hình cảm ứng trên hộp sạc...', 4500000.00, 1, 45, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(7, 10, 10, 'Tai nghe chụp tai Sony WH-1000XM5', 'SON-XM5', 'Chống ồn hàng đầu thế giới', 'Thiết kế mới, pin 30 giờ...', 6990000.00, 1, 120, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(8, 8, 6, 'Kính cường lực Remax GL-27', 'REM-GL27', 'Kính full màn hình cho iPhone', 'Độ cứng 9H, chống bám vân tay...', 90000.00, 1, 300, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(9, 9, 4, 'Giá đỡ điện thoại xe hơi Hoco CA80', 'HOC-CA80', 'Giá đỡ kẹp khe gió điều hòa', 'Xoay 360 độ tiện lợi...', 150000.00, 1, 75, '2025-11-24 01:12:40', '2025-11-24 01:12:40'),
(10, 1, 7, 'Trạm sạc dự phòng Anker 757 PowerHouse', 'ANK-PH-757', 'Trạm năng lượng di động 1229Wh', 'Cung cấp điện cho cả thiết bị gia dụng...', 29000000.00, 1, 12, '2025-11-24 01:12:40', '2025-11-24 01:12:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int NOT NULL COMMENT 'Liên kết với bảng products',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Đường dẫn ảnh',
  `sort_order` int DEFAULT '0' COMMENT 'Thứ tự hiển thị (0 ưu tiên nhất)',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `url`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'cucsacnhanh30w.webp', 1, '2025-11-24 01:21:34', '2025-11-26 08:32:37'),
(2, 2, 'capsac.webp', 2, '2025-11-24 01:21:34', '2025-11-26 08:32:54'),
(3, 3, 'chuotkhongday.webp', 1, '2025-11-24 01:21:34', '2025-11-26 08:34:21'),
(4, 4, 'oplung.webp', 2, '2025-11-24 01:21:34', '2025-11-26 08:34:41'),
(5, 5, 'sacxiaomi.webp', 3, '2025-11-24 01:21:34', '2025-11-26 08:34:59'),
(6, 6, 'taingheblue.webp', 1, '2025-11-24 01:21:34', '2025-11-26 08:35:16'),
(7, 7, 'tainghechuptai.webp', 2, '2025-11-24 01:21:34', '2025-11-26 08:35:29'),
(8, 8, 'kinhcuonglucc.webp', 1, '2025-11-24 01:21:34', '2025-11-26 08:35:51'),
(9, 9, 'giadodienthoai.webp', 2, '2025-11-24 01:21:34', '2025-11-26 08:36:20'),
(10, 10, 'tramsacduphong.webp', 1, '2025-11-24 01:21:34', '2025-11-26 08:36:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int NOT NULL,
  `product_id` int NOT NULL COMMENT 'Liên kết với bảng products',
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã kho riêng cho từng biến thể',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Giá riêng của biến thể (nếu khác giá gốc)',
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cân nặng (lưu chuỗi theo thiết kế)',
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Màu sắc',
  `status` tinyint DEFAULT '1' COMMENT '1: Còn hàng, 0: Hết hàng',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `price`, `weight`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'LOG-MX3S-GR', 2190000.00, '141g', 'Graphite (Đen nhám)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(2, 3, 'LOG-MX3S-PG', 2250000.00, '141g', 'Pale Grey (Xám nhạt)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(3, 7, 'SON-XM5-BK', 6990000.00, '250g', 'Black (Đen)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(4, 7, 'SON-XM5-SV', 6890000.00, '250g', 'Silver (Bạc)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(5, 2, 'BAS-CBL-WH', 120000.00, '50g', 'White (Trắng)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(6, 2, 'BAS-CBL-BK', 120000.00, '50g', 'Black (Đen)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(7, 4, 'APP-CASE-CLR', 1100000.00, '80g', 'Clear (Trong suốt)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(8, 4, 'APP-CASE-MID', 1100000.00, '80g', 'Midnight (Xanh đen)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(9, 1, 'ANK-30W-VT', 350000.00, '40g', 'Violet (Tím)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35'),
(10, 1, 'ANK-30W-BL', 350000.00, '40g', 'Blue (Xanh dương)', 1, '2025-11-24 01:22:35', '2025-11-24 01:22:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint DEFAULT '0' COMMENT '0: User, 1: Admin',
  `status` tinyint DEFAULT '1' COMMENT '1: Active, 0: Inactive',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `role`, `status`, `password_hash`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Van A', 'vana.nguyen@example.com', '0901234567', 'avatar_a.jpg', 1, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(2, 'Tran Thi B', 'thib.tran@example.com', '0912345678', 'avatar_b.jpg', 0, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(3, 'Le Van C', 'vanc.le@example.com', '0923456789', NULL, 0, 1, '$2y$10$X7...HASH...', NULL, '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(4, 'Pham Minh D', 'minhd.pham@example.com', '0934567890', 'avatar_d.jpg', 0, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(5, 'Hoang Thi E', 'thie.hoang@example.com', '0945678901', NULL, 0, 0, '$2y$10$X7...HASH...', '2023-10-01 03:00:00', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(6, 'Doan Van F', 'vanf.doan@example.com', '0956789012', 'avatar_f.jpg', 0, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(7, 'Vo Thi G', 'thig.vo@example.com', '0967890123', 'avatar_g.jpg', 1, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(8, 'Bui Van H', 'vanh.bui@example.com', '0978901234', NULL, 0, 1, '$2y$10$X7...HASH...', NULL, '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(9, 'Dang Thi I', 'thii.dang@example.com', '0989012345', 'avatar_i.jpg', 0, 1, '$2y$10$X7...HASH...', '2025-11-24 00:58:40', '2025-11-24 00:58:40', '2025-11-24 00:58:40'),
(10, 'Ngo Van K', 'vank.ngo@example.com', '0990123456', 'avatar_k.jpg', 0, 0, '$2y$10$X7...HASH...', '2023-09-15 01:30:00', '2025-11-24 00:58:40', '2025-11-24 00:58:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Người dùng yêu thích',
  `product_id` int NOT NULL COMMENT 'Sản phẩm yêu thích',
  `variant_id` int DEFAULT NULL COMMENT 'Biến thể cụ thể (nếu có)',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian thêm vào wishlist'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `variant_id`, `added_at`) VALUES
(1, 1, 3, 1, '2025-11-24 01:26:13'),
(2, 1, 7, 3, '2025-11-24 01:26:13'),
(3, 2, 4, 7, '2025-11-24 01:26:13'),
(4, 3, 10, NULL, '2025-11-24 01:26:13'),
(5, 4, 2, 5, '2025-11-24 01:26:13'),
(6, 5, 6, NULL, '2025-11-24 01:26:13'),
(7, 6, 8, NULL, '2025-11-24 01:26:13'),
(8, 7, 3, 2, '2025-11-24 01:26:13'),
(9, 8, 9, NULL, '2025-11-24 01:26:13'),
(10, 9, 1, 9, '2025-11-24 01:26:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slug` (`slug`),
  ADD KEY `idx_author` (`author_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slug` (`slug`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_cart` (`user_id`),
  ADD KEY `fk_cart_product` (`product_id`),
  ADD KEY `fk_cart_variant` (`variant_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent_id` (`parent_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_code` (`code`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_orders` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_id` (`order_id`),
  ADD KEY `fk_items_product` (`product_id`),
  ADD KEY `fk_items_variant` (`variant_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_brand` (`brand_id`),
  ADD KEY `idx_category` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wishlist_item` (`user_id`,`product_id`,`variant_id`),
  ADD KEY `fk_wishlist_product` (`product_id`),
  ADD KEY `fk_wishlist_variant` (`variant_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_parent` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_items_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `fk_variants_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wishlist_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
