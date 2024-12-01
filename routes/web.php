<?php

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\CustomerController;
use App\Controllers\DefaultController;
use App\Controllers\InvoiceController;
use App\Controllers\ProductController;
use App\Controllers\PurchaseController;
use App\Controllers\StockController;
use App\Controllers\SupplierController;
use App\Controllers\UnitController;
use App\Controllers\UserController;
use App\Middlewares\Middleware;
use Container\ServiceContainer;

$router = new AltoRouter();

$serviceContainer = new ServiceContainer();

// Default Controller
$router->map('GET', '/get-category', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(DefaultController::class);
    $controller->getCategory();
}, 'get.category');

$router->map('GET', '/get-product', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(DefaultController::class);
    $controller->getProduct();
}, 'get.product');

$router->map('GET', '/check-product', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(DefaultController::class);
    $controller->getStock();
}, 'check.product.stock');


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

$router->map('GET', '/forgot-password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->forgotPasswordPage();
}, 'forgot.password');

$router->map('POST', '/send-password-reset', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->sendPasswordReset();
}, 'send.password.reset');

$router->map('GET', '/confirm-email-page', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->confirmEmailPage();
}, 'confirm.email.page');

$router->map('POST', '/reset-password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->resetPassword();
}, 'reset.password');

$router->map('GET', '/reset-password', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(AuthController::class);
    $controller->resetPasswordPage();
}, 'reset.password.page');

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

$router->map('GET', '/redirect', function () use ($serviceContainer) {
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->handleGoogleCallback();
}, 'google.callback');

$router->map('GET', '/profile', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->profile();
}, 'profile');

$router->map('POST', '/update-profile', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->updateProfile();
}, 'update.profile');

$router->map('GET', '/change/password/page', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->changePasswordPage();
}, 'change.password.page');

$router->map('POST', '/change-password', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(UserController::class);
    $controller->changePassword();
}, 'change.password');


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

$router->map('GET', '/credit/customer', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->creditCustomer();
}, 'credit.customer');

$router->map('GET', '/credit/customer/print/pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->creditCustomerPrintPDF();
}, 'credit.customer.print.pdf');

$router->map('GET', '/customer/edit/invoice/[i:invoice_id]', function ($invoice_id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerEditInvoice($invoice_id);
}, 'customer.edit.invoice');

$router->map('POST', '/customer/update/invoice/[i:invoice_id]', function ($invoice_id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerUpdateInvoice($invoice_id);
}, 'customer.update.invoice');

$router->map('GET', '/customer/invoice/details/[i:invoice_id]', function ($invoice_id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerInvoiceDetails($invoice_id);
}, 'customer.invoice.details');

$router->map('GET', '/paid/customer', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->paidCustomer();
}, 'paid.customer');

$router->map('GET', '/paid/customer/print/pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->paidCustomerPrintPDF();
}, 'paid.customer.print.pdf');

$router->map('GET', '/customer/wise/report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerWiseReport();
}, 'customer.wise.report');

$router->map('GET', '/customer/wise/credit/report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerWiseCreditReport();
}, 'customer.wise.credit.report');

$router->map('GET', '/customer/wise/paid/report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CustomerController::class);
    $controller->customerWisePaidReport();
}, 'customer.wise.paid.report');


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
$router->map('GET', '/all-categories', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoriesAll();
}, 'all.categories');

$router->map('GET', '/add-category', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoryAdd();
}, 'add.category');

$router->map('POST', '/store-category', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoryStore();
}, 'store.category');

$router->map('GET', '/edit-category/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoryEdit($id);
}, 'edit.category');

$router->map('POST', '/update-category', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoryUpdate();
}, 'update.category');

$router->map('GET', '/delete-category/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(CategoryController::class);
    $controller->categoryDelete($id);
}, 'delete.category');


// Product routes
$router->map('GET', '/all-products', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productsAll();
}, 'all.products');

$router->map('GET', '/add-product', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productAdd();
}, 'add.products');

$router->map('POST', '/store-product', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productStore();
}, 'store.product');

$router->map('GET', '/edit-product/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productEdit($id);
}, 'edit.product');

$router->map('POST', '/update-product', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productUpdate();
}, 'update.product');

$router->map('GET', '/delete-product/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(ProductController::class);
    $controller->productDelete($id);
}, 'delete.product');


// Purchases routes
$router->map('GET', '/all-purchases', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchasesAll();
}, 'all.purchases');

$router->map('GET', '/add-purchase', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseAdd();
}, 'add.purchase');

$router->map('POST', '/store-purchase', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseStore();
}, 'store.purchase');

$router->map('GET', '/edit-purchase/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseEdit($id);
}, 'edit.purchase');

$router->map('POST', '/update-purchase', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseUpdate();
}, 'update.purchase');

$router->map('GET', '/delete-purchase/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseDelete($id);
}, 'delete.purchase');

$router->map('GET', '/pending-purchase', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchasePending();
}, 'pending.purchase');

$router->map('GET', '/approve-status-purchase/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->purchaseApprove($id);
}, 'approve.status.purchase');

$router->map('GET', '/daily/purchase/report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->dailyPurchaseReport();
}, 'daily.purchase.report');

$router->map('GET', '/daily/purchase/report/PDF', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(PurchaseController::class);
    $controller->dailyPurchaseReportPDF();
}, 'daily.purchase.report.pdf');


// Invoice routes
$router->map('GET', '/all-invoices', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoicesAll();
}, 'all.invoices');

$router->map('GET', '/add-invoice', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceAdd();
}, 'add.invoice');

$router->map('POST', '/store-invoice', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceStore();
}, 'store.invoice');

$router->map('GET', '/invoice/pending-list', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoicePendingList();
}, 'pending.list.invoice');

$router->map('GET', '/invoice/delete/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceDelete($id);
}, 'delete.invoice');

$router->map('GET', '/invoice/approve/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceApprove($id);
}, 'approve.invoice');

$router->map('POST', '/approval/store/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->approvalStore($id);
}, 'approval.store');

$router->map('GET', '/print/invoice-list', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoicePrintList();
}, 'print.invoice.list');

$router->map('GET', '/print/invoice/[i:id]', function ($id) use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoicePrint($id);
}, 'print.invoice');

$router->map('GET', '/download-file', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->downloadFile();
}, 'download.file');

$router->map('GET', '/invoice/daily-report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceDailyReport();
}, 'invoice.daily.report');

$router->map('GET', '/invoice/daily-pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(InvoiceController::class);
    $controller->invoiceDailyPDF();
}, 'invoice.daily.pdf');


// Stock routes
$router->map('GET', '/stock/report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(StockController::class);
    $controller->stockReport();
}, 'stock.report');

$router->map('GET', '/stock/report-pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(StockController::class);
    $controller->stockReportPDF();
}, 'stock.report.pdf');

$router->map('GET', '/supplier/product/wise-report', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(StockController::class);
    $controller->stockSupplierWise();
}, 'supplier.product.wise.report');

$router->map('GET', '/supplier/wise-pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(StockController::class);
    $controller->supplierWisePDF();
}, 'supplier.wise.pdf');

$router->map('GET', '/product/wise-pdf', function () use ($serviceContainer) {
    Middleware::authMiddleware();
    $controller = $serviceContainer->resolve(StockController::class);
    $controller->productWisePDF();
}, 'product.wise.pdf');

$match = $router->match();
