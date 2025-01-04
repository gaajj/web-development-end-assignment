<?php

namespace App\Controllers;

use App\Services\PostService;

class HomeController
{
    public function index()
    {
        session_start();

        // Get the logged-in user's username, if available
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

        // Fetch all posts using the PostService
        $postService = new PostService();
        $posts = $postService->getAll();

        // Include the home view and pass the data
        include '../views/home/index.php';

        include '../views/home/index.php';
    }

    public function about()
    {
        include '../views/home/about.php';
    }
}
