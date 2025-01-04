<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;

class ProfileController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function showProfile($username)
    {
        session_start();

        $user = $this->userService->getByUsername($username);

        if ($user) {
            // 1: Edit if own profile
            if ($user->username == $_SESSION['username']) {
                header('Location: /profile/' . $username . '/edit');
                exit();
            } else {
                // 2: Edit if admin
                if ($_SESSION['role'] == 'admin') {
                    header('Location: /profile/' . $username . '/edit');
                    exit();
                } else {
                    // 3: Show profile
                    include __DIR__ . '/../views/profile/profile.php';
                }
            }
        } else {
            include __DIR__ . '/../views/profile/error.php';
        }
    }

    public function editProfile($username)
    {
        session_start();
        $user = $this->userService->getByUsername($username);

        if (!$user) {
            include __DIR__ . '/../views/profile/error.php';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newUsername = $_POST['username'];
            $newEmail = $_POST['email'];

            // Check for changes
            if ($newUsername === $user->username && $newEmail === $user->email) {
                $_SESSION['profile_message'] = 'No changes detected.';
                header('Location: /profile/' . $user->username);
                exit();
            }

            // Username: Check length
            if (strlen($newUsername) < 3) {
                $_SESSION['profile_message'] = 'Username is too short (minimum 3 characters).';
                header('Location: /profile/' . $user->username);
                exit();
            }

            // Username: Check availability    
            if ($this->userService->checkUsernameTaken($newUsername)) {
                $_SESSION['profile_message'] = 'Username is already taken.';
                header('Location: /profile/' . $user->username);
                exit();
            }

            try {
                if ($this->userService->updateByUsername($user->username, $newUsername, $newEmail)) {
                    // Set session username if logged in
                    if ($_SESSION['username'] === $user->username) {
                        $_SESSION['username'] = $newUsername;
                        $_SESSION['email'] = $newEmail;
                    }
                    $_SESSION['profile_message'] = 'Profile updated successfully!';
                    header('Location: /profile/' . $newUsername);
                    exit();
                } else {
                    $_SESSION['profile_message'] = 'Failed to update profile!';
                    header('Location: /profile/' . $user->username);
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['profile_message'] = 'An error occurred: ' . $e->getMessage();
                header('Location: /profile/' . $user->username);
                exit();
            }
        } else {
            // on GET request
            include __DIR__ . '/../views/profile/edit.php';
        }
    }

    public function updateProfilePicture($username)
    {
        session_start();

        // Check if user exists
        $user = $this->userService->getByUsername($username);
        if (!$user) {
            include __DIR__ . '/../views/profile/error.php';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['picture'])) {
            $file = $_FILES['picture'];
            $fileName = uniqid() . '_' . basename($file['name']);
            $uploadPath = '/uploads/profiles/' . $fileName;
            $tempPath = $file['tmp_name'];

            $allowedTypes = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowedTypes)) {
                // TODO: Message handler : only ... files allowed
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            $ffmpegCommand = "ffmpeg -i $tempPath -vf 'scale=500:01' -quality 85 $uploadPath 2>&1";
            exec($ffmpegCommand, $output, $returnCode);

            if ($returnCode !== 0) {
                //message : error
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            try {
                if ($this->userService->updateProfilePicture($username, $uploadPath)) {
                    $_SESSION['profile_picture'] = $uploadPath;
                    // message : updated succefully
                } else {
                    throw new Exception('Failed to update profile picture');
                }
            } catch (Exception $e) {
                if (file_exists($uploadPath)) {
                    unlink($uploadPath);
                }
                // message : error updating pic
            }

            header('Location: /profile/' . $username . '/edit');
            exit();
        }
        // If not POST request, redirect to edit page
        header('Location: /profile/' . $username . '/edit');
        exit();
    }
}
