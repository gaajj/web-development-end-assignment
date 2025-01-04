<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        session_start();

        include '../views/home/index.php';
    }

    public function about()
    {
        include '../views/home/about.php';
    }
}
