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
}

?>