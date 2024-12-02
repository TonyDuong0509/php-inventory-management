<?php

namespace App\Controllers;

use App\Services\UserService;
use Exception;

use function Utils\Functions\getDateTime;
use function Utils\Functions\mailer;

class AuthController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerForm()
    {
        require ABSPATH . 'resources/auth/registerForm.php';
    }

    public function register()
    {
        $fullName = $_POST['fullName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = "Employee";
        $status = 0;

        $this->userService->getAllUsers() ? $role = $role : $role = "Admin";
        if ($role === 'Admin') $status = 1;


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

        $activation_token = bin2hex(random_bytes(16));
        $activation_token_hash = hash('sha256', $activation_token);

        $params = [
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'created_at' => getDateTime(),
            'updated_at' => getDateTime(),
            'status' => $status,
            'account_activation_hash' => $activation_token_hash
        ];

        $this->userService->store($params);

        $mail = mailer();

        $mail->setFrom("duonganhhao4751@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Activation Account";
        $mail->Body = <<<END
        Click <a href="http://inventory.com/active-account?active-token=$activation_token">here</a> to activate your account
        END;

        try {
            $mail->send();
        } catch (Exception $error) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Sign up successfully'
        ];

        header("Location: /active-account-page");
        exit;
    }

    public function activeAccount()
    {
        $active_token = $_GET['active-token'];
        $active_token_hash = hash('sha256', $active_token);

        $user = $this->userService->getByActiveToken($active_token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $this->userService->activeAccount($user->getId());

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Actived account, you can log in'
        ];

        header("Location: /login-form");
        exit;
    }

    public function loginForm()
    {
        require ABSPATH . 'resources/auth/loginForm.php';
    }

    public function login()
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

        if ($user->getAccountActivationHash() !== null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Your account is inactive, please check your email to active !'
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

    public function logout()
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

    public function forgotPasswordPage()
    {
        require ABSPATH . 'resources/auth/forgot-password.php';
    }

    public function confirmEmailPage()
    {
        require ABSPATH . 'resources/auth/confirmEmailPage.php';
    }


    public function activeAccountPage()
    {
        require ABSPATH . 'resources/auth/activeAccountPage.php';
    }

    public function sendPasswordReset()
    {
        $email = $_POST['email'];

        if (!$this->userService->getByEmail($email)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Email is not exist, please try again'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $token_hash = hash('sha256', $token);
        $expiry = date('Y-m-d H:i:s', time() + 60 * 30);

        $this->userService->sendPasswordReset($token_hash, $expiry, $email);

        $mail = mailer();

        $mail->setFrom("duonganhhao4751@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        Click <a href="http://inventory.com/reset-password?token=$token">here</a> to reset your password
        END;

        try {
            $mail->send();
        } catch (Exception $error) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }

        header("Location: /confirm-email-page");
        exit;
    }

    public function resetPasswordPage()
    {
        $token = $_GET['token'];
        $token_hash = hash('sha256', $token);

        $user = $this->userService->getByToken($token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (strtotime($user->getResetTokenExpiresAt() <= time())) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token is valid and has not expired'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        require ABSPATH . 'resources/auth/resetPasswordPage.php';
    }

    public function resetPassword()
    {
        $token = $_POST['token'];
        $token_hash = hash('sha256', $token);

        $user = $this->userService->getByToken($token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (strtotime($user->getResetTokenExpiresAt() <= time())) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token is valid and has not expired'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->setPassword($password);

        $result = $this->userService->resetPassword($user);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Reset password failed, please try again'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Reseted Password successfully, you can login'
        ];
        header("Location: /login-form");
        exit;
    }
}
