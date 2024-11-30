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

    public function handleGoogleCallback()
    {
        $client = new \Google\Client();
        $client->setClientId($_ENV['GOOGLE_ID']);
        $client->setClientSecret($_ENV['GOOGLE_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT']);

        // Kiểm tra mã xác thực từ Google
        if (!isset($_GET['code'])) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Login failed!'
            ];
            header("Location: /login-form");
            exit;
        }

        // Lấy access token từ mã xác thực
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            die("Error: " . $token['error']);
        }

        // Thiết lập token và lấy thông tin người dùng
        $client->setAccessToken($token['access_token']);
        $oauth = new \Google\Service\Oauth2($client);
        $userinfo = $oauth->userinfo->get();

        // Lấy thông tin từ Google
        $googleId = $userinfo->id;
        $email = $userinfo->email;
        $fullName = $userinfo->name;

        // Kiểm tra email trong database
        $user = $this->userService->getByEmail($email);

        if (!$user) {
            // Nếu không tồn tại, tạo tài khoản mới
            $params = [
                'fullName' => $fullName,
                'email' => $email,
                'password' => null, // Vì đăng nhập bằng Google, không cần mật khẩu
                'phone' => null,
                'role' => 'Employee',
                'status' => 0,
                'created_at' => getDateTime(),
                'updated_at' => getDateTime(),
            ];

            $this->userService->store($params);

            // Lấy lại người dùng vừa tạo
            $user = $this->userService->getByEmail($email);
        }

        // Lưu thông tin đăng nhập vào session
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'fullName' => $user->getFullName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Login successfully with Google'
        ];

        // Chuyển hướng về dashboard
        header("Location: /");
        exit;
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
