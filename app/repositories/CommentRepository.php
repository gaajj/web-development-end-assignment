<?php

namespace App\Repositories;

use PDO;
use App\Models\Comment;

class Commentrepository
{
    private $db;

    public function __construct()
    {
        include __DIR__ . '/../config/dbconfig.php';
        $this->db = new PDO("$type:host=$servername;dbname=$dbname", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllByPostId($postId)
    {
        $query = '
        SELECT comments.*, users.username , users.profile_picture
        FROM comments 
        INNER JOIN users ON comments.user_id = users.id 
        WHERE comments.post_id = :post_id AND comments.is_deleted = 0
        ORDER BY comments.created_at DESC
        ';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($results as $row) {
            $comment = new Comment(
                $row['id'],
                $row['user_id'],
                $row['post_id'],
                $row['content'],
                $row['created_at'],
                $row['is_deleted']
            );
            $comment->username = $row['username'];
            $comment->profile_picture = $row['profile_picture'];
            $comments[] = $comment;
        }
        return $comments;
    }

    public function getCommentById($id)
    {
        $query = 'SELECT * FROM comments WHERE id = :id AND is_deleted = 0';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $comment = new Comment(
                $result['id'],
                $result['user_id'],
                $result['post_id'],
                $result['content'],
                $result['created_at'],
                $result['is_deleted']
            );
            return $comment;
        }
        return null;
    }

    public function addComment($comment)
    {
        $query = 'INSERT INTO comments (user_id, post_id, content, created_at, is_deleted)
              VALUES (:user_id, :post_id, :content, NOW(), 0)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $comment->user_id);
        $stmt->bindParam(':post_id', $comment->post_id);
        $stmt->bindParam(':content', $comment->content);
        $stmt->execute();
    }

    public function removeComment($comment)
    {
        $query = 'UPDATE comments SET is_deleted = 1 WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $comment->id);
        $stmt->execute();
    }
}
