<?php

require_once "Models/BrandModel.php";

class BrandController
{
    private $brandModel;

    public function __construct()
    {
        $this->brandModel = new BrandModel();
    }

    public function index()
    {
        $brands = $this->brandModel->getAllBrands();
        require_once "Views/admin/brand-index.php";
    }
}

?>