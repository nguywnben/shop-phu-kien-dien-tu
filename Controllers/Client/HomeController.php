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
        foreach ($products as $i => $p) {
            $products[$i]['images'] = [];
            if (isset($p['id'])) {
                $products[$i]['images'] = $this->productModel->getImagesByProductId($p['id']);
            }
        }
        require_once "Views/client/index.php";
    }
}
