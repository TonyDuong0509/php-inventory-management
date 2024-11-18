<?php

use App\Controllers\SupplierController;
use App\Controllers\UserController;
use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// User routes
$router->map('GET', '/', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->dashboard();
}, 'dashboard');


// Supplier routes
$router->map('GET', '/all-suppliers', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->suppliersAll();
}, 'all.suppliers');

$router->map('GET', '/add-supplier', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierAdd();
}, 'add.supplier');

$router->map('POST', '/store-supplier', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierStore();
}, 'store.supplier');

$match = $router->match();
