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
            // If own profile, redirect to edit
            if (isset($_SESSION['username']) && $user->username == $_SESSION['username']) {
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            // If logged in as admin, redirect to edit
            if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            //  show profile page
            include __DIR__ . '/../views/profile/profile.php';
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

            // Check for file upload errors
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['profile_message'] = 'File upload error: ' . $file['error'];
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            // Generate a unique file name
            $fileName = uniqid() . '_' . basename($file['name']);
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/profiles/';
            $uploadPath = $uploadDir . $fileName;
            $tempPath = $file['tmp_name'];

            // Ensure the upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowedTypes)) {
                $_SESSION['profile_message'] = 'Only JPEG and PNG files are allowed.';
                header('Location: /profile/' . $username . '/edit');
                exit();
            }

            // Move the uploaded file
            if (move_uploaded_file($tempPath, $uploadPath)) {
                try {
                    // Update the profile picture path in the database
                    $relativePath = $fileName;
                    if ($this->userService->updateProfilePicture($username, $relativePath)) {
                        $_SESSION['profile_picture'] = $relativePath;
                        $_SESSION['profile_message'] = 'Profile picture updated successfully!';
                    } else {
                        throw new Exception('Failed to update profile picture in the database.');
                    }
                } catch (Exception $e) {
                    // Delete the uploaded file if an error occurs
                    if (file_exists($uploadPath)) {
                        unlink($uploadPath);
                    }
                    $_SESSION['profile_message'] = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $_SESSION['profile_message'] = 'Failed to move uploaded file.';
            }

            header('Location: /profile/' . $username . '/edit');
            exit();
        }

        // If not a POST request, redirect to the edit page
        header('Location: /profile/' . $username . '/edit');
        exit();
    }

    public function deleteProfile($username)
    {
        $user = $this->userService->getByUsername($username);
        if ($user) {
            $this->userService->deleteProfile($user);
        } else {
            // error
        }
    }

    public function getUserJson($username)
    {
        header('Content-Type: application/json');
        $user = $this->userService->getByUsername($username);
        echo json_encode($user);
    }
}
