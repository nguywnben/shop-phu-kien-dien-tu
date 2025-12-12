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
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        $categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getProductsFiltered($keyword, $categoryId);
        foreach ($products as $i => $p) {
            $products[$i]['images'] = [];
            if (isset($p['id'])) {
                $products[$i]['images'] = $this->productModel->getImagesByProductId($p['id']);
            }
        }
        require_once "Views/client/index.php";
    }
}
