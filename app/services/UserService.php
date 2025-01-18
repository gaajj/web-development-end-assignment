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

    public function getById($id)
    {
        return $this->userRepository->getById($id);
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

    public function deleteProfile($user)
    {
        return $this->userRepository->deleteProfile($user);
    }

    public function authenticate(string $username, string $password)
    {
        $user = $this->userRepository->getByUsername($username);
        return $user && password_verify($password, $user->password) ? $user : null;
    }

    public function register(string $username, string $password, ?string $email)
    {
        if ($this->checkUsernameTaken($username)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(null, $username, $hashedPassword, $email, null, null, 0);
        $this->userRepository->create($user);

        return true;
    }
}
