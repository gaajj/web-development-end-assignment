<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\PostService;
use App\Services\CommentService;

class PostController
{
    private $postService;
    private $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function showPost($post_id)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->addComment($post_id);
        }

        $post = $this->postService->getById($post_id);
        $comments = $this->commentService->getAllByPostId($post_id);

        if ($post) {
            include __DIR__ . '/../views/post/post.php';
        } else {
            echo "post not found";
        }
    }

    public function addComment($post_id)
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = trim($_POST['content']);

            if (!empty($content)) {
                $comment = new Comment();
                $comment->post_id = $post_id;
                $comment->user_id = $_SESSION['user_id'];
                $comment->content = $content;
                $this->commentService->addComment($comment);

                header('Location: /post/' . $post_id);
                exit;
            } else {
                $_SESSION['error_message'] = 'Comment content cannot be empty.';
                header('Location: /post/' . $post_id);
                exit;
            }
        } else {
            //show error invalid request
        }
    }
}
