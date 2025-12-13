<?php
require_once "Models/PostModel.php";

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index()
    {
        $posts = $this->postModel->getActivePosts();
        require_once "Views/client/blog.php";
    }

    public function detail()
    {
        $id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
        
        if ($id <= 0) {
            echo "Bài viết không hợp lệ.";
            return;
        }

        $post = $this->postModel->getPostById($id);
        
        if (!$post || $post['status'] != 1) {
            echo "Không tìm thấy bài viết.";
            return;
        }

        require_once "Views/client/blog-detail.php";
    }
}
