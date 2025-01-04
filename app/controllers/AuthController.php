<?php

namespace App\Controllers;

use App\Services\UserService;

class AuthController
{
    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function login()
    {
        session_start();
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userService->authenticate($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                $_SESSION['role'] = $user->role;
                $_SESSION['profile_picture'] = '/../uploads/profiles/' . $user->profile_picture;

                header('Location: /');
                exit();
            } else {
                $message = "Invalid username or password";
            }
        }
        include __DIR__ . '/../views/home/login.php';
    }

    public function register()
    {
        session_start();
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'] ?? null;

            $success = $this->userService->register($username, $password, $email);

            if ($success) {
                header("Location: /login");
                exit();
            } else {
                $_SESSION['message'] = "Username is already taken.";
                header("Location: /register");
                exit();
            }
        }

        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        include __DIR__ . '/../views/home/register.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
        exit();
    }
}
