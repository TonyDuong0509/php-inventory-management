<?php

use App\Controllers\AuthController;
use App\Controllers\CustomerController;
use App\Controllers\SupplierController;
use App\Controllers\UnitController;
use App\Controllers\UserController;
use App\Middlewares\Middleware;
use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// Auth routes
$router->map('GET', '/register-form', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->registerForm();
}, 'register.form');

$router->map('POST', '/register', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->register();
}, 'register');

$router->map('GET', '/login-form', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->loginForm();
}, 'login.form');

$router->map('POST', '/login', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->login();
}, 'login');

$router->map('GET', '/logout', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->logout();
}, 'logout');


// User routes
$router->map('GET', '/', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->dashboard();
}, 'dashboard');


// Supplier routes
$router->map('GET', '/all-suppliers', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->suppliersAll();
}, 'all.suppliers');

$router->map('GET', '/add-supplier', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierAdd();
}, 'add.supplier');

$router->map('POST', '/store-supplier', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierStore();
}, 'store.supplier');

$router->map('GET', '/edit-supplier/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierEdit($id);
}, 'edit.supplier');

$router->map('POST', '/update-supplier', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierUpdate();
}, 'update.supplier');

$router->map('GET', '/delete-supplier/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(SupplierController::class);
    $controller->supplierDelete($id);
}, 'delete.supplier');


// Customer routes
$router->map('GET', '/all-customers', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customersAll();
}, 'all.customers');

$router->map('GET', '/add-customer', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerAdd();
}, 'add.customer');

$router->map('POST', '/store-customer', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerStore();
}, 'store.customer');

$router->map('GET', '/edit-customer/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerEdit($id);
}, 'edit.customer');

$router->map('POST', '/update-customer', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerUpdate();
}, 'update.customer');

$router->map('GET', '/delete-customer/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerDelete($id);
}, 'delete.customer');


// Unit routes
$router->map('GET', '/all-units', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitsAll();
}, 'all.units');

$router->map('GET', '/add-unit', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitAdd();
}, 'add.units');

$router->map('POST', '/store-unit', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitStore();
}, 'store.unit');

$router->map('GET', '/edit-unit/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitEdit($id);
}, 'edit.unit');

$router->map('POST', '/update-unit', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitUpdate();
}, 'update.unit');

$router->map('GET', '/delete-unit/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UnitController::class);
    $controller->unitDelete($id);
}, 'delete.unit');


// Category routes

$match = $router->match();
