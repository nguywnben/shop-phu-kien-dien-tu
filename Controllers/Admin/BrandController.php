<?php

require_once "Models/BrandModel.php";

class BrandController
{
    private $brandModel;

    private $uploadDir = "Assets/client/img/";

    public function __construct()
    {
        $this->brandModel = new BrandModel();
        // Đảm bảo thư mục upload tồn tại (tạo nếu chưa có)
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }


    public function index()
    {
        $brands = $this->brandModel->getAllBrands();
        require_once "Views/admin/brand-index.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=brands&action=index');
            exit;
        }

        $brand = $this->brandModel->getById((int) $id);

        if (!$brand) {
            session_start();
            $_SESSION['error'] = 'Thương hiệu không tồn tại.';
            header('location: ?page=brands&action=index');
            exit;
        }

        require_once "Views/admin/brand-edit.php";
    }

    // Phương thức xử lý logic cập nhật dữ liệu
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ?page=brands&action=index');
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        // Đọc dữ liệu đầu vào
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';
        $old_logo_url = $_POST['old_logo'] ?? '';


        $hasError = false;
        $_SESSION['name_error'] = '';
        $_SESSION['slug_error'] = '';
        $_SESSION['status_error'] = '';
        $_SESSION['logo_error'] = '';

        $_SESSION['name_old'] = $name;
        $_SESSION['slug_old'] = $slug;
        $_SESSION['status_old'] = $status;

        if (empty($name)) {
            $_SESSION['name_error'] = 'Vui lòng nhập tên thương hiệu.';
            $hasError = true;
        }
        if ($this->brandModel->checkNameExists($name, $id)) {
            $_SESSION['name_error'] = 'Tên thương hiệu này đã tồn tại.'; $hasError = true;
        }
        if (empty($slug)) {
            $_SESSION['slug_error'] = 'Vui lòng nhập URL (Slug)';
            $hasError = true;
        }
        if ($status === '') {
            $_SESSION['status_error'] = 'Vui lòng chọn trạng thái.';
            $hasError = true;
        }

        if ($hasError) {
            header('location: ?page=brands&action=edit&id=' . $id);
            exit;
        }


        $existing = $this->brandModel->getById($id);
        if (!$existing) {
            $_SESSION['error'] = 'Thương hiệu không tồn tại.';
            header('location: ?page=brands&action=index');
            exit;
        }


        $logo_to_save = $existing['logo'] ?? null;

        // --- XỬ LÝ UPLOAD FILE LOGO MỚI ---
        if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['logo']['name'];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Tạo tên file mới
            $new_name = $slug . '-' . time() . '.' . $file_extension;
            $target_file = $this->uploadDir . $new_name;

            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $logo_to_save = $new_name;

                // Xóa file logo cũ (nếu có và khác logo mặc định)
                $old_file_name = $existing['logo'] ?? null;
                $old_file_path = $this->uploadDir . $old_file_name;

                // Chỉ xóa nếu có file cũ và nó tồn tại
                if ($old_file_name && file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            } else {
                $_SESSION['logo_error'] = 'Tải file logo thất bại!';
                header('location: ?page=brands&action=edit&id=' . $id);
                exit;
            }
        }

        $result = $this->brandModel->updateBrand($id, $name, $slug, $logo_to_save, $status);

        if ($result) {
            // Xóa session dữ liệu cũ và lỗi
            unset($_SESSION['name_old'], $_SESSION['slug_old'], $_SESSION['status_old']);
            unset($_SESSION['name_error'], $_SESSION['slug_error'], $_SESSION['status_error'], $_SESSION['logo_error']);
            $_SESSION['success'] = 'Cập nhật thương hiệu thành công';
            header('location: ?page=brands&action=index');
            exit;
        } else {
            $_SESSION['error'] = 'Cập nhật thương hiệu thất bại';
            header('location: ?page=brands&action=edit&id=' . $id);
            exit;
        }
    }


    public function delete()
    {
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        if ($id !== null) {
            $brand = $this->brandModel->getById((int) $id);
            if ($brand) {

                $logo_name = $brand['logo'] ?? null;
                $logo_path = $this->uploadDir . $logo_name;

                if ($logo_name && file_exists($logo_path)) {
                    unlink($logo_path);
                }

                $this->brandModel->deleteBrand((int) $id);
                session_start();
                $_SESSION['success'] = 'Xóa thương hiệu thành công.';
            } else {
                session_start();
                $_SESSION['error'] = 'Không tìm thấy thương hiệu để xóa.';
            }
        }
        header("Location: ?page=brands&action=index");
        exit();
    }
    public function add()
    {
        require_once "Views/admin/brand-add.php";
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: ?page=brands&action=index');
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

       
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $status = ($_POST['status'] === '0' || $_POST['status'] === '1') ? $_POST['status'] : '';
        $logo_file = $_FILES['logo'] ?? null;


        $hasError = false;
        $_SESSION['name_error'] = '';
        $_SESSION['slug_error'] = '';
        $_SESSION['status_error'] = '';
        $_SESSION['logo_error'] = '';

        $_SESSION['name_old'] = $name;
        $_SESSION['slug_old'] = $slug;
        $_SESSION['status_old'] = $status;

        if (empty($name)) {
            $_SESSION['name_error'] = 'Vui lòng nhập tên thương hiệu.';
            $hasError = true;
        }
        if ($this->brandModel->checkNameExists($name)) {
            $_SESSION['name_error'] = 'Tên thương hiệu này đã tồn tại.'; $hasError = true;
        }
        if (empty($slug)) {
            $_SESSION['slug_error'] = 'Vui lòng nhập URL thân thiện.';
            $hasError = true;
        }
        if ($status === '') {
            $_SESSION['status_error'] = 'Vui lòng chọn trạng thái.';
            $hasError = true;
        }
  
        if (!$logo_file || empty($logo_file['name']) || $logo_file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['logo_error'] = 'Vui lòng chọn file logo.';
            $hasError = true;
        }

        if ($hasError) {
            header('location: ?page=brands&action=add');
            exit;
        }

    
        $logo_to_save = null; 

        $file_name = $logo_file['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = $slug . '-' . time() . '.' . $file_extension;
        $target_file = $this->uploadDir . $new_name;

        if (move_uploaded_file($logo_file["tmp_name"], $target_file)) {
            $logo_to_save = $new_name; 
        } else {
            $_SESSION['error'] = 'Lỗi khi tải file logo lên máy chủ.';
            header('location: ?page=brands&action=add');
            exit;
        }

        // Thực hiện thêm mới vào DB
        $result = $this->brandModel->createBrand($name, $slug, $logo_to_save, $status);

        if ($result) {
            // Xóa session dữ liệu cũ và lỗi
            unset($_SESSION['name_old'], $_SESSION['slug_old'], $_SESSION['status_old']);
            unset($_SESSION['name_error'], $_SESSION['slug_error'], $_SESSION['status_error'], $_SESSION['logo_error']);
            $_SESSION['success'] = 'Thêm thương hiệu thành công';
            header('location: ?page=brands&action=index');
            exit;
        } else {
  
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            $_SESSION['error'] = 'Thêm thương hiệu thất bại';
            header('location: ?page=brands&action=add');
            exit;
        }
    }
}

?>