<?php

require_once "Models/UserModel.php";

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        require_once "Views/admin/user-index.php";
    }
}

?>