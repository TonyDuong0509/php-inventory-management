<?php

require_once ABSPATH . 'app/repositories/interfaces/SupplierRepositoryInterface.php';

require_once ABSPATH . 'app/models/Supplier.php';
require_once ABSPATH . 'app/repositories/SupplierRepository.php';

require_once ABSPATH . 'container/ServiceContainer.php';

require_once ABSPATH . 'app/services/SupplierService.php';

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
