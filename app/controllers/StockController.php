<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\InvoiceService;
use App\Services\ProductService;
use App\Services\PurchaseService;
use App\Services\SupplierService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class StockController
{
    private $productService;
    private $supplierService;
    private $categoryService;
    private $purchaseService;
    private $invoiceService;
    private $userService;

    public function __construct(
        ProductService $productService,
        SupplierService $supplierService,
        CategoryService $categoryService,
        PurchaseService $purchaseService,
        InvoiceService $invoiceService,
        UserService $userService,
    ) {
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->categoryService = $categoryService;
        $this->purchaseService = $purchaseService;
        $this->invoiceService = $invoiceService;
        $this->userService = $userService;
    }

    public function stockReport()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $products = $this->productService->getStockReport();

        $buying_totals = [];
        $selling_totals = [];
        foreach ($products as $product) {
            $buying_totals[$product->getId()] = $this->purchaseService->totalBuying($product->getCategoryId(), $product->getId());
            $selling_totals[$product->getId()] = $this->invoiceService->totalSelling($product->getCategoryId(), $product->getId());
        }

        require ABSPATH . 'resources/stock/stockReport.php';
    }


    public function stockReportPDF()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $products = $this->productService->getStockReport();

        $buying_totals = [];
        $selling_totals = [];
        foreach ($products as $product) {
            $buying_totals[$product->getId()] = $this->purchaseService->totalBuying($product->getCategoryId(), $product->getId());
            $selling_totals[$product->getId()] = $this->invoiceService->totalSelling($product->getCategoryId(), $product->getId());
        }

        $date = getDateTime();

        require ABSPATH . 'resources/stock/stockReportPDF.php';
    }

    public function stockSupplierWise()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $suppliers = $this->supplierService->getAllSuppliers();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/stock/supplierProductWiseReport.php';
    }

    public function supplierWisePDF()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $supplier_id = $_GET['supplier_id'] ?? '';
        $products = $this->productService->getSupplierWise($supplier_id);

        $date = getDateTime();

        require ABSPATH . 'resources/stock/supplierWiseReportPDF.php';
    }

    public function productWisePDF()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $category_id = $_GET['category_id'] ?? '';
        $product_id = $_GET['product_id'] ?? '';
        $products = $this->productService->getProductWise($category_id, $product_id);

        $date = getDateTime();

        require ABSPATH . 'resources/stock/productWiseReportPDF.php';
    }
}
