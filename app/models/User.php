<?php

namespace App\Models;

class User
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $role;
    public $profile_picture;

    public function __construct($id, $username, $password, $email, $role = 'user', $picture_path = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->profile_picture = $picture_path;
    }
}
