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

        include __DIR__ . '/../views/admin/admin.php';
    }

    public function getUsersJson()
    {
        header('Content-Type: application/json');
        $users = $this->userService->getAll();
        echo json_encode($users);
    }
}
