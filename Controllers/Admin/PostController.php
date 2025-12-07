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
        $posts = $this->postModel->getAllPosts();
        require_once "Views/admin/post-index.php";
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';
        if ($id == '') {
            header('location: ?page=posts&action=index');
            exit;
        }
        $post = $this->postModel->getPostById($id);
        if (!$post) {
            header('HTTP/1.0 404 Not Found');
            require_once "Views/admin/404.php";
            exit;
        }
        require_once "Views/admin/post-edit.php";
    }

    public function update()
    {
        if (!isset($_POST["btn_update"])) {
            header("location: admin.php?page=posts&action=index");
            exit;
        }
        $errors = [];
        $postId = $_POST["id"] ?? "";
        $title = $_POST["title"] ?? "";
        $slug = $_POST["slug"] ?? "";
        $content = $_POST["content"] ?? "";
        $coverImage = $_POST["cover_image"] ?? "";
        $authorId = $_POST["author_id"] ?? "";
        $status = $_POST["status"] ?? "";
        $publishedAt = $_POST["published_at"] ?? "";
        $created_At = $_POST["created_at"] ?? "";
        $updated_At = $_POST["updated_at"] ?? "";
        if (empty($title)) {
            $errors["title"] = "Tiêu đề không được để trống.";
        } 
        if (empty($slug)) {
            $errors["slug"] = "Đường dẫn SEO không được để trống.";
        }
        if (empty($content)) {
            $errors["content"] = "Nội dung bài viết không được để trống.";
        }
        if (empty($coverImage)) {
            $errors["cover_image"] = "Ảnh đại diện bài viết không được để trống.";
        }
        if (empty($authorId)){
            $errors["author_id"] = "Tác giả không được để trống.";
        }
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            header("location: admin.php?page=posts&action=edit&id=" . $postId);
            exit;
        }
        $data = [
            "id" => $postId,
            "title" => $title,
            "slug" => $slug,
            "content" => $content,
            "cover_image" => $coverImage,
            "author_id" => $authorId,
            "status" => $status,
            "published_at" => $publishedAt,
            "created_at" => $created_At,
            "updated_at" => $updated_At
        ];
        $result = $this->postModel->updatePost($data);
        if ($result) {
            $_SESSION["success"] = "Chỉnh sửa bài viết thành công.";
            header("location: admin.php?page=posts&action=index");
            exit;
        }
    }

    public function add()
    {
        require_once "Views/admin/post-add.php";
    }
    public function delete()
    {

        $id = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
        } else {
            $id = $_GET['id'] ?? '';
        }

        if (empty($id) || !is_numeric($id)) {
            header('location: ?page=posts&action=index');
            exit;
        }

        $posts = $this->postModel->delete((int) $id);
        if ($posts) {
            $_SESSION['success'] = 'Xóa bài viết thành công';
        } else {
            $_SESSION['error'] = 'Xóa bài viết thất bại';
        }
        header('location: ?page=posts&action=index');
        exit;
    }

}
?>