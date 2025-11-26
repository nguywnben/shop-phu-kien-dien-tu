<?php

require_once "Models/CategoryModel.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
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
        require_once "Views/admin/category-edit.php";
    }
    public function update()
    {
        // Trigger update on POST request (form submits with name 'btn_update')
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? 0);
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

                $target_dir = "Assets/category/thumbnail/";
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
            $result = $this->categoryModel->updateCategory($id, $name, $status);

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