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
}

?>