<?php

namespace App\Models;

class Post
{
    public $id;
    public $title;
    public $content;
    public $date_posted;
    public $upvote_count;
    public $downvote_count;
    public $author_id;
    public $is_deleted;

    public function __construct($id = null, $title = null, $content = null, $date_posted = null, $upvote_count = 0, $downvote_count = 0, $author_id = null, $is_deleted = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->date_posted = $date_posted;
        $this->upvote_count = $upvote_count;
        $this->downvote_count = $downvote_count;
        $this->author_id = $author_id;
        $this->is_deleted = $is_deleted;
    }
}
