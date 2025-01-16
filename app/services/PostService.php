<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\PostRepository;

class PostService
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }

    public function getById($id)
    {
        return $this->postRepository->getById($id);
    }
}
