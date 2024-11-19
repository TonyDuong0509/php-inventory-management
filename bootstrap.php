<?php

// Repository Interfaces
require_once ABSPATH . 'app/repositories/interfaces/SupplierRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/UserRepositoryInterface.php';


// Models && Repositories
require_once ABSPATH . 'app/models/Supplier.php';
require_once ABSPATH . 'app/repositories/SupplierRepository.php';
require_once ABSPATH . 'app/models/User.php';
require_once ABSPATH . 'app/repositories/UserRepository.php';

require_once ABSPATH . 'container/ServiceContainer.php';


// Services
require_once ABSPATH . 'app/services/SupplierService.php';
require_once ABSPATH . 'app/services/UserService.php';


// Middlewares
require_once ABSPATH . 'app/middlewares/Middleware.php';

//inventory.com
function get_host_name()
{
    return $_SERVER['HTTP_HOST'];
}
//http://
function getProtocol()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $protocol;
}

//http://inventory.com
function get_domain()
{
    $protocol = getProtocol();
    return $protocol . $_SERVER['HTTP_HOST'];
}
