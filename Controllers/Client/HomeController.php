<?php
require_once "Models/CategoryModel.php";
require_once "Models/ProductModel.php";
class HomeController
{
    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getAllProducts();
        require_once "Views/client/index.php";
    }
}
