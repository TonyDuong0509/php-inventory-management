<?php

namespace App\Controllers;

use App\Services\UserService;

class AuthController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerForm(): void
    {
        require ABSPATH . 'resources/auth/registerForm.php';
    }

    public function register(): void
    {
        $fullName = $_POST['fullName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = "User";

        $this->userService->getAllUsers() ? $role = $role : $role = "Admin";

        if ($this->userService->getByEmail($email)) {
            $_SESSION['formData'] = [
                'fullName' => $fullName,
                'email' => $email,
                'phone' => $phone,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This email already exist, please try another email'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $params = [
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->userService->store($params);

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Register successfully, you can log in'
        ];

        header("Location: /login-form");
        exit;
    }

    public function loginForm(): void
    {
        require ABSPATH . 'resources/auth/loginForm.php';
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if (!$user) {
            $_SESSION['formData'] = [
                'email' => $email,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Email is not exist, please try again or register new account'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            $_SESSION['formData'] = [
                'email' => $email,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Password incorrect, please try again'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'fullName' => $user->getFullName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Login successfully'
        ];

        header("Location: /");
        exit;
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'success',
                'message' => 'Logout successfully'
            ];
        }

        header("Location: /login-form");
        exit;
    }
}
