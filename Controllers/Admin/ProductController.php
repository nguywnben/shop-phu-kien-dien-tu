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
        // Lấy danh mục và thương hiệu để đổ vào form select
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
}

?>