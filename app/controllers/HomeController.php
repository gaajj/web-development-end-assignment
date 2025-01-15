<?php

namespace App\Controllers;

use App\Services\PostService;

class HomeController
{
    public function index()
    {
        session_start();

        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

        $postService = new PostService();
        $posts = $postService->getAll();

        include '../views/home/index.php';
    }

    public function about()
    {
        include '../views/home/about.php';
    }
}
