<?php

namespace App\Controllers;

use App\Services\UserService;

use function Utils\Functions\getDateTime;
use function Utils\Functions\handleImage;

class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        require ABSPATH . 'resources/dashboard/index.php';
    }

    public function profile()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        require ABSPATH . 'resources/user/profile.php';
    }

    public function updateProfile()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $fullName = $_POST['fullName'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $old_image = $_POST['old_image'] ?? 'public/uploads/no_image.jpg';
        $updated_at = getDateTime();

        if ($_FILES['avatar']['name']) {
            $avatar = handleImage('public/uploads/user/', 'avatar', $old_image);
        } else {
            $avatar = $old_image;
        }

        $user->setFullName($fullName);
        $user->setPhone($phone);
        $user->setAvatar($avatar);
        $user->setUpdatedAt($updated_at);

        $result = $this->userService->update($user);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Updated user failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated user successfully'
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function changePasswordPage()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        require ABSPATH . 'resources/user/changePasswordPage.php';
    }

    public function changePassword()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $oldPassword = $_POST['password'];
        $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        if (!password_verify($oldPassword, $user->getPassword())) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Old password incorrect'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $user->setPassword($password);
        $result = $this->userService->updatePassword($user);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Change password failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Change password successfully'
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
