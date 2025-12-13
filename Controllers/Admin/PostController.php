<?php

require_once "Models/PostModel.php";
require_once "Models/UserModel.php";

class PostController
{
    private $postModel;
    private $userModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->userModel = new UserModel();
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
        $users = $this->userModel->getAllUsers();
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

        $post = $this->postModel->getPostById($postId);
        if (!$post) {
            $_SESSION["error"] = "Bài viết không tồn tại.";
            header("location: admin.php?page=posts&action=index");
            exit;
        }

        $title = $_POST["title"] ?? "";
        $slug = $_POST["slug"] ?? "";
        $content = $_POST["content"] ?? "";
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
        if (empty($authorId)){
            $errors["author_id"] = "Tác giả không được để trống.";
        }

        // Handle file upload (optional). If no new file, keep old cover.
        $coverImage = $post['cover_image'] ?? '';
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
            $file = $_FILES['cover_image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($file['type'], $allowedTypes)) {
                $errors["cover_image"] = "Định dạng file không hỗ trợ. Vui lòng upload file ảnh (jpg, png, gif, webp).";
            } elseif ($file['size'] > 5 * 1024 * 1024) { // 5MB
                $errors["cover_image"] = "Kích thước file quá lớn. Tối đa 5MB.";
            } else {
                $uploadDir = "Assets/admin/images/product/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileName = uniqid() . '_' . basename($file['name']);
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $coverImage = $filePath;
                } else {
                    $errors["cover_image"] = "Lỗi khi upload ảnh. Vui lòng thử lại.";
                }
            }
        }

        if (empty($coverImage)) {
            $errors["cover_image"] = "Ảnh đại diện bài viết không được để trống.";
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
        $users = $this->userModel->getAllUsers();
        require_once "Views/admin/post-add.php";
    }

    public function store()
    {
        if (!isset($_POST["create"])) {
            header("location: admin.php?page=posts&action=index");
            exit;
        }

        $errors = [];
        $title = $_POST["title"] ?? "";
        $slug = $_POST["slug"] ?? "";
        $content = $_POST["content"] ?? "";
        $authorId = $_POST["author_id"] ?? "";
        $status = $_POST["status"] ?? "1";
        $coverImage = "";

        // Validation
        if (empty($title)) {
            $errors["title"] = "Tiêu đề không được để trống.";
        }
        
        if (empty($slug)) {
            $errors["slug"] = "Đường dẫn SEO không được để trống.";
        }
        
        if (empty($content)) {
            $errors["content"] = "Nội dung bài viết không được để trống.";
        }
        
        if (empty($authorId)) {
            $errors["author_id"] = "Tác giả không được để trống.";
        }

        // Handle file upload
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
            $file = $_FILES['cover_image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            
            if (!in_array($file['type'], $allowedTypes)) {
                $errors["cover_image"] = "Định dạng file không hỗ trợ. Vui lòng upload file ảnh (jpg, png, gif, webp).";
            } elseif ($file['size'] > 5 * 1024 * 1024) { // 5MB
                $errors["cover_image"] = "Kích thước file quá lớn. Tối đa 5MB.";
            } else {
                $uploadDir = "Assets/admin/images/product/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileName = uniqid() . '_' . basename($file['name']);
                $filePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $coverImage = $filePath;
                } else {
                    $errors["cover_image"] = "Lỗi khi upload ảnh. Vui lòng thử lại.";
                }
            }
        } else {
            $errors["cover_image"] = "Ảnh đại diện bài viết không được để trống.";
        }

        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION["title_old"] = $title;
            $_SESSION["slug_old"] = $slug;
            $_SESSION["content_old"] = $content;
            $_SESSION["author_id_old"] = $authorId;
            $_SESSION["status_old"] = $status;
            header("location: admin.php?page=posts&action=add");
            exit;
        }

        $result = $this->postModel->createPost($title, $slug, $content, $coverImage, $authorId, $status);
        if ($result) {
            $_SESSION["success"] = "Thêm bài viết thành công.";
            header("location: admin.php?page=posts&action=index");
            exit;
        } else {
            $_SESSION["error"] = "Thêm bài viết thất bại. Vui lòng thử lại.";
            $_SESSION["title_old"] = $title;
            $_SESSION["slug_old"] = $slug;
            $_SESSION["content_old"] = $content;
            $_SESSION["author_id_old"] = $authorId;
            $_SESSION["status_old"] = $status;
            header("location: admin.php?page=posts&action=add");
            exit;
        }
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