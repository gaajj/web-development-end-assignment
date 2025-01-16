<?php

namespace App\Models;

class Comment
{
    public $id;
    public $user_id;
    public $post_id;
    public $content;
    public $created_at;
    public $is_deleted;
    public $username;

    public function __construct($id = null, $user_id = null, $post_id = null, $content = null, $created_at = null, $is_deleted = 0, $username = null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->is_deleted = $is_deleted;
        $this->username = $username;
    }
}
