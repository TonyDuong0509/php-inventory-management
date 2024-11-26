<?php

// Repository Interfaces
require_once ABSPATH . 'app/repositories/interfaces/SupplierRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/UserRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/CustomerRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/UnitRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/CategoryRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/ProductRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/ProductRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/InvoiceRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/PaymentRepositoryInterface.php';
require_once ABSPATH . 'app/repositories/interfaces/PurchaseRepositoryInterface.php';


// Models && Repositories
require_once ABSPATH . 'app/models/Supplier.php';
require_once ABSPATH . 'app/repositories/SupplierRepository.php';
require_once ABSPATH . 'app/models/User.php';
require_once ABSPATH . 'app/repositories/UserRepository.php';
require_once ABSPATH . 'app/models/Customer.php';
require_once ABSPATH . 'app/repositories/CustomerRepository.php';
require_once ABSPATH . 'app/models/Unit.php';
require_once ABSPATH . 'app/repositories/UnitRepository.php';
require_once ABSPATH . 'app/models/Category.php';
require_once ABSPATH . 'app/repositories/CategoryRepository.php';
require_once ABSPATH . 'app/models/Product.php';
require_once ABSPATH . 'app/repositories/ProductRepository.php';
require_once ABSPATH . 'app/models/Purchase.php';
require_once ABSPATH . 'app/repositories/PurchaseRepository.php';
require_once ABSPATH . 'app/models/Invoice.php';
require_once ABSPATH . 'app/repositories/InvoiceRepository.php';
require_once ABSPATH . 'app/models/InvoiceDetails.php';
require_once ABSPATH . 'app/models/Payment.php';
require_once ABSPATH . 'app/repositories/PaymentRepository.php';
require_once ABSPATH . 'app/models/PaymentDetails.php';

require_once ABSPATH . 'container/ServiceContainer.php';


// Services
require_once ABSPATH . 'app/services/SupplierService.php';
require_once ABSPATH . 'app/services/UserService.php';
require_once ABSPATH . 'app/services/CustomerService.php';
require_once ABSPATH . 'app/services/UnitService.php';
require_once ABSPATH . 'app/services/CategoryService.php';
require_once ABSPATH . 'app/services/ProductService.php';
require_once ABSPATH . 'app/services/PurchaseService.php';
require_once ABSPATH . 'app/services/InvoiceService.php';
require_once ABSPATH . 'app/services/PaymentService.php';


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
