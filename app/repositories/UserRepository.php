<?php

namespace App\Repositories;

use PDO;
use App\Models\User;
use ArrayObject;

class UserRepository
{
    private $db;

    public function __construct()
    {
        include __DIR__ . '/../config/dbconfig.php';
        $this->db = new PDO("$type:host=$servername;dbname=$dbname", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAll()
    {
        $query = 'SELECT id, username, password, email, role, profile_picture FROM users';
        $stmt = $this->db->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($results as $result) {
            $users[] = new User($result['id'], $result['username'], $result['password'], $result['email'], $result['role'], $result['profile_picture']);
        }
        return $users;
    }

    public function getByUsername($username)
    {
        $query = 'SELECT id, username, password, email, role, profile_picture FROM users WHERE username=:username';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['id'], $result['username'], $result['password'], $result['email'], $result['role'], $result['profile_picture']);
        }

        return null;
    }

    public function checkUsernameTaken($username)
    {
        $query = 'SELECT id FROM users WHERE username=:username';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) return True;
        else return False;
    }

    public function update($userId, $username, $email)
    {
        $query = 'UPDATE users SET username=:username, email=:email WHERE id=:id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function updateByUsername($currentUsername, $newUsername, $newEmail)
    {
        $query = 'UPDATE users SET username = :newUsername, email = :newEmail WHERE username = :currentUsername';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':newUsername', $newUsername);
        $stmt->bindParam(':newEmail', $newEmail);
        $stmt->bindParam(':currentUsername', $currentUsername);
        return $stmt->execute();
    }

    public function updateProfilePicture($username, $picturePath)
    {
        $query = 'UPDATE users SET picture_path = :picture_path WHERE username = :username';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':picture_path', $picturePath);
        $stmt->bindParam(':username', $username);
        return $stmt->execute();
    }

    public function create(User $user)
    {
        $query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $user->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
        $stmt->execute();
    }
}
