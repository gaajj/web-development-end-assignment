<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
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

    public function createPost($title, $content, $author_id)
    {
        $post = new Post(
            null,
            $title,
            $content,
            null,
            0,
            0,
            $author_id,
            0
        );

        return $this->postRepository->create($post);
    }

    public function removePost($post_id)
    {
        return $this->postRepository->remove($post_id);
    }
}
