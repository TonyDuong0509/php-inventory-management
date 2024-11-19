<?php

use App\Controllers\AuthController;
use App\Controllers\SupplierController;
use App\Controllers\UserController;
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

$match = $router->match();
