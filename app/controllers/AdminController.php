<?php

namespace App\Controllers;

use App\Services\UserService;

class AdminController
{
    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function admin()
    {
        session_start();

        $users = $this->userService->getAll();

        include __DIR__ . '/../views/admin/admin.php';
    }
}
