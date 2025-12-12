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

        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        $categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

        $perPage = 8;
        $currentPage = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        $offset = ($currentPage - 1) * $perPage;

        $totalProducts = $this->productModel->countProductsFiltered($keyword, $categoryId);
        $totalPages = $totalProducts > 0 ? (int) ceil($totalProducts / $perPage) : 1;

        $products = $this->productModel->getProductsFilteredPaginated($keyword, $categoryId, $perPage, $offset);
        foreach ($products as $i => $p) {
            $products[$i]['images'] = [];
            if (isset($p['id'])) {
                $products[$i]['images'] = $this->productModel->getImagesByProductId($p['id']);
            }
        }
        $totalProducts = $totalProducts;
        $totalPages = $totalPages;
        $currentPage = $currentPage;
        $perPage = $perPage;
        $keyword = $keyword;
        $categoryId = $categoryId;
        require_once "Views/client/shop.php";
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