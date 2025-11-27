<?php
require_once "Models/CategoryModel.php";
require_once "Models/ProductModel.php";
class ShopController
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
    public function details()
    {
        $id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
        if ($id <= 0) {
            echo "Sản phẩm không hợp lệ.";
            return;
        }
        $product = $this->productModel->getById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }
        $product['images'] = $this->productModel->getImagesByProductId($id);
        require_once "Views/client/details.php";
    }
}