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
  
        $limit = 10; 
        $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $limit;

        $products = $this->productModel->getAllProductsForAdmin($limit, $offset);
        
   
        $totalProducts = $this->productModel->countProducts();
        $totalPages = ceil($totalProducts / $limit);

        $pagination = [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'totalProducts' => $totalProducts,
        ];
        
        require_once "Views/admin/product-index.php";

    }
    public function add()
    {
        require_once "Models/CategoryModel.php";
        require_once "Models/BrandModel.php";

        // Lấy danh mục và thương hiệu để đổ vào form select
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        $brandModel = new BrandModel();
        $brands = $brandModel->getAllBrands();

        require_once "Views/admin/product-add.php";
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ?page=products&action=index');
            exit;
        }

        // Đọc dữ liệu đầu vào
        $name = trim($_POST['name'] ?? '');
        $sku_model = trim($_POST['sku_model'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $price = $_POST['price'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $brand_id = $_POST['brand_id'] ?? '';
        $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';
        $is_featured = ($_POST['is_featured'] === '0' || $_POST['is_featured'] === '1') ? $_POST['is_featured'] : '0';

        // Khởi tạo và Lưu trữ dữ liệu cũ
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        $_SESSION['name_error'] = '';
        $_SESSION['sku_model_error'] = '';
        $_SESSION['price_error'] = '';
        $_SESSION['category_id_error'] = '';
        $_SESSION['status_error'] = '';
        $_SESSION['thumbnail_error'] = ""; // Lỗi tải ảnh

        // Lưu trữ dữ liệu cũ vào session
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
        } elseif ($this->productModel->checkNameExists($name)) {
            $_SESSION['name_error'] = 'Tên sản phẩm này đã tồn tại.';
        }
        if (empty($sku_model)) {
            $_SESSION['sku_model_error'] = 'Vui lòng nhập mã SKU hoặc model sản phẩm';
        }

        if ($price === '' || !is_numeric($price) || floatval($price) < 0) {
            $_SESSION['price_error'] = 'Vui lòng nhập giá hợp lệ';
        }

        if ($category_id === '' || !is_numeric($category_id)) {
            $_SESSION['category_id_error'] = 'Vui lòng chọn danh mục';
        }

        if ($status === '') {
            $_SESSION['status_error'] = 'Vui lòng chọn trạng thái';
        }

        // Ảnh là bắt buộc khi thêm mới
        if (empty($_FILES['thumbnail']['name']) || $_FILES['thumbnail']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['thumbnail_error'] = 'Vui lòng chọn ảnh chính cho sản phẩm';
        }

        // Nếu có lỗi xác thực, chuyển hướng quay lại trang thêm
        if (!empty($_SESSION['name_error']) || !empty($_SESSION['sku_model_error']) || !empty($_SESSION['price_error']) || !empty($_SESSION['category_id_error']) || !empty($_SESSION['status_error']) || !empty($_SESSION['thumbnail_error'])) {
            header('location: ?page=products&action=add');
            exit;
        }

        // --- Xử lý Lưu vào DB ---

        // 1. Thêm sản phẩm vào bảng products và lấy ID sản phẩm mới
        $newProductId = $this->productModel->createProduct(
            $name,
            $sku_model,
            $description,
            $content,
            $price,
            (int) $category_id,
            ($brand_id === '' ? null : (int) $brand_id),
            $status,
            $is_featured
        );

        if ($newProductId) {
            $new_image_url = null;

            // 2. Xử lý tải lên ảnh
            $image = $_FILES['thumbnail']['name'];
            $target_dir = "Assets/client/img/";
            $new_name = date("YmdHis") . '_' . basename($image);
            $target_file = $target_dir . $new_name;

            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                $new_image_url = $new_name;

                // 3. Thêm URL ảnh mới vào bảng product_images
                $image_inserted = $this->productModel->insertMainImage($newProductId, $new_image_url);

                if ($image_inserted) {
                    // Thành công: Xóa session cũ và chuyển hướng
                    unset($_SESSION['name_old'], $_SESSION['sku_model_old'], $_SESSION['description_old'], $_SESSION['content_old'], $_SESSION['price_old'], $_SESSION['category_id_old'], $_SESSION['brand_id_old'], $_SESSION['status_old'], $_SESSION['is_featured_old']);
                    unset($_SESSION['name_error'], $_SESSION['sku_model_error'], $_SESSION['price_error'], $_SESSION['category_id_error'], $_SESSION['status_error'], $_SESSION['thumbnail_error']);
                    $_SESSION['success'] = 'Thêm sản phẩm thành công';
                    header('location: ?page=products&action=index');
                    exit;
                } else {
                    // Lỗi: Lưu sản phẩm thành công nhưng không lưu được ảnh -> Xóa sản phẩm và file vừa tải lên
                    $this->productModel->deleteProduct($newProductId);
                    if (file_exists($target_file)) {
                        unlink($target_file);
                    }
                    $_SESSION['error'] = 'Thêm sản phẩm thất bại (Lỗi lưu ảnh CSDL)';
                    header('location: ?page=products&action=add');
                    exit;
                }

            } else {
                // Lỗi: Lưu sản phẩm thành công nhưng không tải được file ảnh -> Xóa sản phẩm
                $this->productModel->deleteProduct($newProductId);
                $_SESSION['error'] = 'Thêm sản phẩm thất bại (Lỗi tải file ảnh)';
                header('location: ?page=products&action=add');
                exit;
            }

        } else {
            // Lỗi: Không thể thêm sản phẩm vào bảng products
            $_SESSION['error'] = 'Thêm sản phẩm thất bại (Lỗi CSDL)';
            header('location: ?page=products&action=add');
            exit;
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=products&action=index');
            exit;
        }

        $product = $this->productModel->getById((int) $id);

        // Kiểm tra sản phẩm có tồn tại không
        if (!$product) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }


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

        // Đảm bảo sản phẩm tồn tại trước khi xóa
        $existing = $this->productModel->getById((int) $id);
        if (!$existing) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        try {
            // Lưu ý: Nếu có ràng buộc khóa ngoại (foreign key) cascade delete giữa products và product_images, 
            // thì chỉ cần gọi deleteProduct. Nếu không, bạn cần thêm logic xóa ảnh chính và các ảnh phụ trước.
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

        // Khởi tạo lại các lỗi xác thực trong session và lưu dữ liệu cũ
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
        $_SESSION['name_error'] = '';
        $_SESSION['sku_model_error'] = '';
        $_SESSION['price_error'] = '';
        $_SESSION['category_id_error'] = '';
        $_SESSION['status_error'] = '';
        $_SESSION['thumbnail_error'] = ""; // Sử dụng cho lỗi tải ảnh

        // Lưu trữ dữ liệu cũ
        $_SESSION['name_old'] = $name;
        $_SESSION['sku_model_old'] = $sku_model;
        $_SESSION['description_old'] = $description;
        $_SESSION['content_old'] = $content;
        $_SESSION['price_old'] = $price;
        $_SESSION['category_id_old'] = $category_id;
        $_SESSION['brand_id_old'] = $brand_id;
        $_SESSION['status_old'] = $status;
        $_SESSION['is_featured_old'] = $is_featured;

        // Xác thực các trường bắt buộc (Giữ nguyên)
        if (empty($name)) {
            $_SESSION['name_error'] = 'Vui lòng nhập tên sản phẩm';
        }
        elseif ($this->productModel->checkNameExists($name, $id)) {
            $_SESSION['name_error'] = 'Tên sản phẩm này đã tồn tại.';
        }
        if (empty($sku_model)) {
            $_SESSION['sku_model_error'] = 'Vui lòng nhập mã SKU hoặc model sản phẩm';
        }

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

        // 1. Kiểm tra sự tồn tại của sản phẩm và lấy dữ liệu ảnh cũ
        $existing = $this->productModel->getById($id);
        if (!$existing) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        $old_image_url = $existing['main_image_url'] ?? '';
        $new_image_url = null;

        // 2. Xử lý tải lên ảnh mới (CẬP NHẬT BẢNG PRODUCT_IMAGES)
        if (!empty($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['thumbnail']['name'];
            $target_dir = "Assets/client/img/";
            $new_name = date("YmdHis") . '_' . basename($image);
            $target_file = $target_dir . $new_name;

            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                $new_image_url = $new_name;

                // 3. Gọi Model để CẬP NHẬT URL MỚI vào bảng product_images
                $image_updated = $this->productModel->updateMainImage($id, $new_image_url);

                if ($image_updated) {
                    // 4. Xóa file ảnh cũ nếu có và việc cập nhật Model thành công
                    if (!empty($old_image_url) && file_exists($target_dir . $old_image_url)) {
                        unlink($target_dir . $old_image_url);
                    }
                } else {
                    // Lỗi cập nhật DB, xóa file vừa upload
                    if (file_exists($target_file)) {
                        unlink($target_file);
                    }
                    $_SESSION['thumbnail_error'] = 'Lỗi CSDL khi cập nhật ảnh!';
                    header('location: ?page=products&action=edit&id=' . $id);
                    exit;
                }

            } else {
                $_SESSION['thumbnail_error'] = 'Tải ảnh lên thất bại!';
                header('location: ?page=products&action=edit&id=' . $id);
                exit;
            }
        }

        // 5. Thực hiện cập nhật các trường còn lại của sản phẩm 

        $result = $this->productModel->updateProduct(
            $id,
            $name,
            $sku_model,
            $description,
            $content,
            $price,
            (int) $category_id,
            ($brand_id === '' ? null : (int) $brand_id),
            $status,
            $is_featured
        );

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