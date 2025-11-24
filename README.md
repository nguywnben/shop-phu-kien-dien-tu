## 🛒 DỰ ÁN: WEBSITE THƯƠNG MẠI ĐIỆN TỬ BÁN PHỤ KIỆN ĐIỆN TỬ

### 1. Giới Thiệu Dự Án (Project Description)

Đây là mã nguồn (Source Code) của Dự án Website Thương mại Điện tử chuyên kinh doanh các mặt hàng Phụ kiện Điện tử. Dự án được phát triển nhằm cung cấp một nền tảng mua sắm trực tuyến đầy đủ chức năng, bao gồm các quy trình từ duyệt sản phẩm đến thanh toán và quản lý đơn hàng.

**Thông tin Dự án:**
* **Tên Dự án:** Shop Phụ Kiện Điện Tử
* **Mục đích:** Xây dựng hệ thống E-commerce hoàn chỉnh.
* **Thực hiện bởi:** Nhóm 4, Lớp WD20302 Khóa 20.1
* **Đơn vị:** Cao đẳng FPT Polytechnic (Chuyên ngành Lập trình Web)

### 2. Tính Năng Chính (Key Features)

Hệ thống hiện tại bao gồm các tính năng cốt lõi sau:

* **Quản lý Sản phẩm:** Hiển thị chi tiết sản phẩm, phân loại theo danh mục và quản lý tồn kho.
* **Tìm kiếm và Lọc:** Cung cấp công cụ tìm kiếm mạnh mẽ và bộ lọc đa dạng giúp người dùng dễ dàng tìm thấy sản phẩm.
* **Giỏ hàng:** Chức năng quản lý giỏ hàng linh hoạt (thêm, xóa, cập nhật số lượng).
* **Quy trình Thanh toán:** Hỗ trợ quy trình đặt hàng và thanh toán đơn giản, bảo mật.
* **Hệ thống Người dùng:** Đăng ký, Đăng nhập và quản lý hồ sơ cá nhân.
* **Bảng điều khiển Quản trị (Admin Panel):** Giao diện riêng biệt cho quản trị viên để quản lý dữ liệu sản phẩm, đơn hàng và tài khoản người dùng.

### 3. Công Nghệ Sử Dụng (Tech Stack)

Dự án được xây dựng dựa trên các công nghệ sau:

| Lĩnh vực | Công nghệ | Vai trò chính |
| :--- | :--- | :--- |
| **Backend** | Hack (HHVM) | Xử lý logic nghiệp vụ và phía máy chủ. |
| **Frontend** | HTML5, CSS3 | Xây dựng cấu trúc và giao diện người dùng. |
| **Database** | MySQL / MariaDB | Hệ quản trị cơ sở dữ liệu để lưu trữ thông tin. |

### 4. Hướng Dẫn Cài Đặt (Installation Guide)

Để triển khai dự án trên môi trường cục bộ, vui lòng làm theo các bước dưới đây:

1.  **Sao chép (Clone) mã nguồn:**
    ```bash
    git clone [https://github.com/nguywnben/shop-phu-kien-dien-tu.git](https://github.com/nguywnben/shop-phu-kien-dien-tu.git)
    ```
2.  **Thiết lập Môi trường:** Đảm bảo đã cài đặt môi trường chạy ngôn ngữ Hack/HHVM và máy chủ web (như Apache hoặc Nginx).
3.  **Cấu hình Cơ sở dữ liệu:**
    * Tạo cơ sở dữ liệu mới (ví dụ: `shop_phu_kien`).
    * Import các bảng dữ liệu cần thiết (Nếu có file SQL đính kèm).
    * Cập nhật thông tin kết nối cơ sở dữ liệu (tên CSDL, user, mật khẩu) trong tệp cấu hình.
4.  **Khởi chạy Ứng dụng:** Khởi động máy chủ web và truy cập dự án qua trình duyệt.

### 5. Đóng Góp (Contributing)

Chúng tôi luôn hoan nghênh mọi sự đóng góp để cải thiện dự án. Nếu bạn muốn đóng góp, vui lòng thực hiện theo quy trình sau:

1.  **Fork** dự án này.
2.  Tạo một nhánh mới cho tính năng của bạn: `git checkout -b feature/tên-chức-năng-mới`.
3.  Thực hiện thay đổi và **Commit** với thông điệp rõ ràng: `git commit -m 'feat: Thêm chức năng [Mô tả]'`.
4.  Đẩy lên nhánh mới: `git push origin feature/tên-chức-năng-mới`.
5.  Tạo **Pull Request** (Yêu cầu Hợp nhất) và mô tả chi tiết về các thay đổi.

### 6. Giấy Phép (License)

Dự án này được phát hành dưới **Giấy phép MIT**. Vui lòng tham khảo file `LICENSE.md` để biết chi tiết.

### 7. Thông tin Liên hệ

Mọi thắc mắc hoặc cần hỗ trợ kỹ thuật, vui lòng liên hệ:

* **Tác giả/Nhóm phát triển:** nguywnben (hoặc tên nhóm)
* **Trường:** Cao đẳng FPT Polytechnic
