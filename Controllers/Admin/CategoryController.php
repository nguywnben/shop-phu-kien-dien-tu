<?php


require_once "Models/CategoryModel.php";
require_once "Models/ProductModel.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // Phân trang
        $limit = 10;
        $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $limit;

        // Lấy tổng số danh mục
        $totalCategories = $this->categoryModel->countCategories();
        $totalPages = ceil($totalCategories / $limit);

        // Lấy danh sách danh mục cho trang hiện tại
        $categories = $this->categoryModel->getCategoriesPaginated($limit, $offset);

        // Biến phân trang
        $pagination = [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'limit' => $limit,
            'totalCategories' => $totalCategories,
        ];

        require_once "Views/admin/category-index.php";
    }
    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=categories&action=index');
            exit;
        }
        $category = $this->categoryModel->getOneCategory((int) $id);
        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }
        require_once "Views/admin/category-edit.php";
    }
    public function update()
    {
        // Trigger update on POST request (form submits with name 'btn_update')
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
            // Ensure category exists
            $existing = $this->categoryModel->getOneCategory($id);
            if (!$existing) {
                header('HTTP/1.0 404 Not Found');
                require_once "Views/admin/404.php";
                exit;
            }
            $name = trim($_POST['name'] ?? '');
            $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';
            $image = $_FILES['image']['name'] ?? '';

            // Reset lỗi
            $_SESSION['name_error'] = '';
            $_SESSION['status_error'] = '';
            $_SESSION['image_error'] = '';

            // Validate name
            if (empty($name)) {
                $_SESSION['name_error'] = 'Vui lòng nhập tên danh mục';
            }

            // Validate status
            if ($status === '') {
                $_SESSION['status_error'] = 'Vui lòng chọn trạng thái';
            }


            // Lưu lại giá trị cũ
            $_SESSION['name_old'] = $name;
            $_SESSION['status_old'] = $status;

            // Nếu có lỗi => quay lại form
            if (!empty($_SESSION['name_error']) || !empty($_SESSION['status_error'])) {
                header('location: ?page=categories&action=edit&id=' . $id);
                exit;
            }

            // Kiểm tra tên trùng (loại trừ chính bản ghi đang sửa)
            if ($this->categoryModel->existsByName($name, $id)) {
                $_SESSION['name_error'] = 'Tên danh mục đã tồn tại';
                header('location: ?page=categories&action=edit&id=' . $id);
                exit;
            }

            // Lấy ảnh cũ
            $category = $this->categoryModel->getOneCategory($id);
            $current_image = $category['thumbnail'] ?? '';

            // Nếu có ảnh mới và hợp lệ thì upload
            if (!empty($image) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                $target_dir = "Assets/client/img/";
                $new_name = date("YmdHis") . '_' . basename($image);
                $target_file = $target_dir . $new_name;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_to_save = $new_name;
                } else {
                    $_SESSION['image_error'] = 'Upload ảnh thất bại!';
                    header('location: ?page=categories&action=edit&id=' . $id);
                    exit;
                }
            } else {
                $image_to_save = $current_image;
            }

            // Gọi model update 
            $result = $this->categoryModel->updateCategory($id, $image_to_save, $name, $status);

            if ($result) {
                unset($_SESSION['name_error'], $_SESSION['status_error'], $_SESSION['image_error']);
                unset($_SESSION['name_old'], $_SESSION['status_old']);
                $_SESSION['success'] = 'Cập nhật loại sản phẩm thành công';
                header('location: ?page=categories&action=index');
                exit;
            } else {
                $_SESSION['error'] = 'Cập nhật loại sản phẩm thất bại';
                header('location: ?page=categories&action=edit&id=' . $id);
                exit;
            }
        }
    }
    public function add()
    {
        require_once "Views/admin/category-add.php";
    }
    public function store()
    {
        if (isset($_POST['create'])) {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $status = (isset($_POST['status']) && ($_POST['status'] === '0' || $_POST['status'] === '1')) ? $_POST['status'] : '';
            $image = $_FILES['image']['name'] ?? '';

            // Kiểm tra lỗi
            $_SESSION['name_error'] = '';
            $_SESSION['status_error'] = '';
            $_SESSION['image_error'] = '';

            if (empty($name)) {
                $_SESSION['name_error'] = 'Vui lòng nhập tên loại sản phẩm';
            }
            if ($status === '') {
                $_SESSION['status_error'] = 'Vui lòng chọn trạng thái';
            }
            // Kiểm tra tên đã tồn tại
            $checkName = $this->categoryModel->checkName();
            foreach ($checkName as $check) {
                if ($name == $check['name']) {
                    $_SESSION['name_error'] = 'Tên loại sản phẩm đã tồn tại';
                    break;
                }
            }
            // Kiểm tra hình ảnh
            if (empty($image) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['image_error'] = 'Vui lòng chọn file hợp lệ để upload';
            }

            // Lưu lại giá trị cũ
            $_SESSION['name_old'] = $name;
            $_SESSION['status_old'] = $status;

            if (!empty($_SESSION['name_error']) || !empty($_SESSION['status_error']) || !empty($_SESSION['image_error'])) {
                header('location: ?page=categories&action=add');
                exit;
            }

            // Xử lý upload 
            $target_dir = "Assets/client/img/";
            $new_name = date("YmdHis") . '_' . basename($image);
            $target_file = $target_dir . $new_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Thêm vào CSDL với tên file mới
                $category = $this->categoryModel->insert($name, $new_name, $status);

                if ($category) {
                    unset($_SESSION['name_error'], $_SESSION['status_error'], $_SESSION['image_error']);
                    unset($_SESSION['name_old'], $_SESSION['status_old']);

                    $_SESSION['success'] = 'Thêm loại sản phẩm thành công';
                    header('location: ?page=categories&action=index');
                    exit;
                } else {
                    $_SESSION['error'] = 'Thêm loại sản phẩm thất bại';
                    header('location: ?page=categories&action=add');
                    exit;
                }
            } else {
                $_SESSION['image_error'] = 'Upload ảnh thất bại!';
                header('location: ?page=categories&action=add');
                exit;
            }
        }
    }
    public function delete()
    {

        $id = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
        } else {
            $id = $_GET['id'] ?? '';
        }

        if (empty($id) || !is_numeric($id)) {
            header('location: ?page=categories&action=index');
            exit;
        }
        // Ensure category exists before deleting
        $existing = $this->categoryModel->getOneCategory((int) $id);
        if (!$existing) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }

        // Kiểm tra ràng buộc: Nếu còn sản phẩm thuộc danh mục này thì không cho xóa
        $productModel = new ProductModel();
        if ($productModel->hasProductsInCategory((int)$id)) {
            $_SESSION['error'] = 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này!';
            header('location: ?page=categories&action=index');
            exit;
        }

        // Xóa loại sản phẩm
        $categories = $this->categoryModel->delete((int) $id);
        if ($categories) {
            $_SESSION['success'] = 'Xóa loại sản phẩm thành công';
        } else {
            $_SESSION['error'] = 'Xóa loại sản phẩm thất bại';
        }
        header('location: ?page=categories&action=index');
        exit;
    }
}

?>