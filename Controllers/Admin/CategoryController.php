<?php

require_once "Models/CategoryModel.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        require_once "Views/admin/category-index.php";
    }
}

?>