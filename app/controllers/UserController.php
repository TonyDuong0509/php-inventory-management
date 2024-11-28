<?php

namespace App\Controllers;

class UserController
{

    public function dashboard()
    {
        require ABSPATH . 'resources/dashboard/index.php';
    }
}
