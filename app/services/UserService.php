<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getByUsername($username)
    {
        return $this->userRepository->getByUsername($username);
    }

    public function checkUsernameTaken($username)
    {
        return $this->userRepository->checkUsernameTaken($username);
    }

    public function update($user_id, $username, $email)
    {
        return $this->userRepository->update($user_id, $username, $email);
    }

    public function updateByUsername($currentUsername, $newUsername, $newEmail)
    {
        return $this->userRepository->updateByUsername($currentUsername, $newUsername, $newEmail);
    }

    public function updateProfilePicture($username, $picturePath)
    {
        return $this->userRepository->updateProfilePicture($username, $picturePath);
    }

    public function authenticate(string $username, string $password)
    {
        $user = $this->userRepository->getByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function register(string $username, string $password, ?string $email)
    {
        // username taken
        if ($this->userRepository->getByUsername($username)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(null, $username, $hashedPassword, $email);
        $this->userRepository->create($user);

        return true;
    }
}
