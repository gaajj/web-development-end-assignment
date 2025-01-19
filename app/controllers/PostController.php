<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\UserService;
use App\Services\PostService;
use App\Services\CommentService;

class PostController
{
    private $userService;
    private $postService;
    private $commentService;

    public function __construct()
    {
        $this->userService = new UserService();
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

    public function createPost()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if ($title && $content) {
                $author_id = $_SESSION['user_id'];
                $createdPost = $this->postService->createPost($title, $content, $author_id);

                if ($createdPost) {
                    header('Location: /post/view/' . $createdPost);
                    exit;
                } else {
                    // error
                }
            } else {
                // error
            }
        }

        include __DIR__ . '/../views/post/create_post.php';
    }

    public function removePost($post_id)
    {
        session_start();

        $post = $this->postService->getById($post_id);

        if ($post && ($_SESSION['user_id'] == $post->author_id || $_SESSION['role'] == 'admin')) {
            $this->postService->removePost($post_id);

            header('Location: /');
            exit;
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
            }
            header('Location: /post/view/' . $post_id);
            exit;
        } else {
            //show error invalid request
        }
    }

    public function removeComment($post_id, $comment_id)
    {
        session_start();

        $comment = $this->commentService->getCommentById($comment_id);

        if ($comment && ($_SESSION['user_id'] == $comment->user_id || $_SESSION['role'] == 'admin')) {
            $this->commentService->removeComment($comment);
            header('Location: /post/view/' . $post_id);
            exit;
        }
    }

    public function getPostJson($post_id)
    {
        header('Content-Type: application/json');
        $post = $this->postService->getById($post_id);
        echo json_encode($post);
    }

    public function getPostsJson()
    {
        header('Content-Type: application/json');
        $posts = $this->postService->getAll();
        echo json_encode($posts);
    }
}
