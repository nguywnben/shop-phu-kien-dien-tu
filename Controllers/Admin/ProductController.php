<?php

require_once "Models/ProductModel.php";
require_once "Models/CategoryModel.php";
require_once "Models/BrandModel.php";

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->getAllProducts();
        require_once "Views/admin/product-index.php";

    }
    public function add()
    {
        require_once "Views/admin/product-add.php";
    }
    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=products&action=index');
            exit;
        }
        $product = $this->productModel->getById((int) $id);
        if (!$product) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        // Lấy danh sách danh mục và thương hiệu để đổ vào các ô chọn (select box)
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        $brandModel = new BrandModel();
        $brands = $brandModel->getAllBrands();
        require_once "Views/admin/product-edit.php";
    }
    public function delete()
    {

        $id = $_POST['id'] ?? $_GET['id'] ?? '';
        if ($id === '') {
            header('location: ?page=products&action=index');
            exit;
        }

        // Ensure product exists before attempting to delete
        $existing = $this->productModel->getById((int) $id);
        if (!$existing) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        try {
            $deleted = $this->productModel->deleteProduct((int) $id);
            if ($deleted) {
                session_start();
                $_SESSION['success'] = 'Xóa sản phẩm thành công.';
            } else {
                session_start();
                $_SESSION['error'] = 'Không thể xóa sản phẩm.';
            }
        } catch (Exception $e) {
            session_start();
            $_SESSION['error'] = 'Lỗi khi xóa sản phẩm: ' . $e->getMessage();
        }

        header('location: ?page=products&action=index');
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ?page=products&action=index');
            exit;
        }

        // Đọc dữ liệu đầu vào (inputs)
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $sku_model = trim($_POST['sku_model'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $price = $_POST['price'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $brand_id = $_POST['brand_id'] ?? '';
        $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';
        $is_featured = ($_POST['is_featured'] === '0' || $_POST['is_featured'] === '1') ? $_POST['is_featured'] : '0';

        // Khởi tạo lại các lỗi xác thực trong session
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
        $_SESSION['name_error'] = '';
        $_SESSION['sku_model_error'] = '';
        $_SESSION['price_error'] = '';
        $_SESSION['category_id_error'] = '';
        $_SESSION['status_error'] = '';
        $_SESSION['thumbnail_error'] = "";


        // Lưu trữ dữ liệu cũ vào session để điền lại vào form
        $_SESSION['name_old'] = $name;
        $_SESSION['sku_model_old'] = $sku_model;
        $_SESSION['description_old'] = $description;
        $_SESSION['content_old'] = $content;
        $_SESSION['price_old'] = $price;
        $_SESSION['category_id_old'] = $category_id;
        $_SESSION['brand_id_old'] = $brand_id;
        $_SESSION['status_old'] = $status;
        $_SESSION['is_featured_old'] = $is_featured;

        // Xác thực các trường bắt buộc
        if (empty($name)) {
            $_SESSION['name_error'] = 'Vui lòng nhập tên sản phẩm';
        }
        if (empty($sku_model)) {
            $_SESSION['sku_model_error'] = 'Vui lòng nhập mã SKU hoặc model sản phẩm';
        }

        // Xác thực giá (cho phép nhập số, front-end nên gửi các chữ số thô)
        if ($price === '' || !is_numeric($price) || floatval($price) < 0) {
            $_SESSION['price_error'] = 'Vui lòng nhập giá hợp lệ';
        }

        if ($category_id === '' || !is_numeric($category_id)) {
            $_SESSION['category_id_error'] = 'Vui lòng chọn danh mục';
        }

        if ($status === '') {
            $_SESSION['status_error'] = 'Vui lòng chọn trạng thái';
        }

        // Nếu có lỗi xác thực, chuyển hướng quay lại trang chỉnh sửa
        if (!empty($_SESSION['name_error']) || !empty($_SESSION['sku_model_error']) || !empty($_SESSION['price_error']) || !empty($_SESSION['category_id_error']) || !empty($_SESSION['status_error'])) {
            header('location: ?page=products&action=edit&id=' . $id);
            exit;
        }

        // Xử lý tải lên ảnh thumbnail
        $thumbnail_to_save = $_POST['old_thumbnail'] ?? '';
        if (!empty($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['thumbnail']['name'];
            $target_dir = "Assets/client/img/";
            // Tạo tên file mới dựa trên ngày giờ để tránh trùng lặp
            $new_name = date("YmdHis") . '_' . basename($image);
            $target_file = $target_dir . $new_name;

            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                $thumbnail_to_save = $new_name;
            } else {
                $_SESSION['thumbnail_error'] = 'Tải ảnh lên thất bại!';
                header('location: ?page=products&action=edit&id=' . $id);
                exit;
            }
        }

        // Ensure product exists before updating
        $existing = $this->productModel->getById($id);
        if (!$existing) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        // Thực hiện cập nhật
        $result = $this->productModel->updateProduct($id, $name, $sku_model, $description, $content, $price, (int) $category_id, ($brand_id === '' ? null : (int) $brand_id), $thumbnail_to_save, $status, $is_featured);

        if ($result) {
            // Xóa dữ liệu và lỗi cũ trong session sau khi cập nhật thành công
            unset($_SESSION['name_old'], $_SESSION['sku_model_old'], $_SESSION['description_old'], $_SESSION['content_old'], $_SESSION['price_old'], $_SESSION['category_id_old'], $_SESSION['brand_id_old'], $_SESSION['status_old'], $_SESSION['is_featured_old']);
            unset($_SESSION['name_error'], $_SESSION['sku_model_error'], $_SESSION['price_error'], $_SESSION['category_id_error'], $_SESSION['status_error'], $_SESSION['thumbnail_error']);
            $_SESSION['success'] = 'Cập nhật sản phẩm thành công';
            header('location: ?page=products&action=index');
            exit;
        } else {
            $_SESSION['error'] = 'Cập nhật sản phẩm thất bại';
            header('location: ?page=products&action=edit&id=' . $id);
            exit;
        }
    }
}

?>