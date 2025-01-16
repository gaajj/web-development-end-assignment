<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\Commentrepository;

class CommentService
{
    private $Commentrepository;

    public function __construct()
    {
        $this->Commentrepository = new Commentrepository();
    }

    public function getAllByPostId($id)
    {
        return $this->Commentrepository->getAllByPostId($id);
    }

    public function addComment($comment)
    {
        return $this->Commentrepository->addComment($comment);
    }
}
