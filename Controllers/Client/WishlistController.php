<?php
require_once "Models/WishlistModel.php";
require_once "Models/ProductModel.php";

class WishlistController
{
    private $wishlistModel;
    private $productModel;

    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?page=login&action=index");
            exit();
        }

        $userId = isset($_SESSION['login']['id']) ? (int)$_SESSION['login']['id'] : 0;
        $wishlistItems = $this->wishlistModel->getWishlistByUserId($userId);
        foreach ($wishlistItems as $i => $item) {
            $wishlistItems[$i]['images'] = [];
            if (isset($item['product_id'])) {
                $wishlistItems[$i]['images'] = $this->productModel->getImagesByProductId($item['product_id']);
            }
            $wishlistItems[$i]['stock_status'] = (isset($item['status']) && $item['status'] == 1) ? 'Còn hàng' : 'Hết hàng';
        }

        require_once "Views/client/wishlist.php";
    }

    public function remove()
    {
        if (!isset($_SESSION['login'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập']);
            exit();
        }

        $wishlistId = isset($_POST['wishlist_id']) ? intval($_POST['wishlist_id']) : 0;
        $userId = isset($_SESSION['login']['id']) ? (int)$_SESSION['login']['id'] : 0;

        if ($wishlistId > 0) {
            $result = $this->wishlistModel->removeFromWishlist($wishlistId, $userId);
            if ($result) {
                header("Location: index.php?page=wishlist");
                exit();
            }
        }
        
        echo "Không thể xóa sản phẩm";
    }

    public function add()
    {
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?page=login&action=index");
            exit();
        }

        $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $userId = isset($_SESSION['login']['id']) ? (int)$_SESSION['login']['id'] : 0;
        $variantId = isset($_POST['variant_id']) ? intval($_POST['variant_id']) : null;

        if ($productId > 0) {
            $result = $this->wishlistModel->addToWishlist($userId, $productId, $variantId);
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit();
            }
            
            if ($result['success']) {
                $referer = isset($_POST['referer']) ? $_POST['referer'] : 'index.php?page=shop';
                header("Location: " . $referer);
                exit();
            }
        }
        
        header("Location: index.php?page=shop");
        exit();
    }
}
