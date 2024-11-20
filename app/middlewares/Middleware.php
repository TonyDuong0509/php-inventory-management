<?php

namespace App\Middlewares;

class Middleware
{
    public static function authMiddleware()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Please login to access !'
            ];
            header("Location: /login-form");
            exit;
        }
    }
}
