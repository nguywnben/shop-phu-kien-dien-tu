<?php
require_once "Models/CategoryModel.php";
class HomeController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        require_once "Views/client/index.php";

    }
}