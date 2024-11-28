<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\InvoiceService;
use App\Services\ProductService;
use App\Services\PurchaseService;
use App\Services\SupplierService;

use function Utils\Functions\getDateTime;

class StockController
{
    private $productService;
    private $supplierService;
    private $categoryService;
    private $purchaseService;
    private $invoiceService;

    public function __construct(
        ProductService $productService,
        SupplierService $supplierService,
        CategoryService $categoryService,
        PurchaseService $purchaseService,
        InvoiceService $invoiceService,
    ) {
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->categoryService = $categoryService;
        $this->purchaseService = $purchaseService;
        $this->invoiceService = $invoiceService;
    }

    public function stockReport()
    {
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
        $suppliers = $this->supplierService->getAllSuppliers();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/stock/supplierProductWiseReport.php';
    }

    public function supplierWisePDF()
    {
        $supplier_id = $_GET['supplier_id'] ?? '';
        $products = $this->productService->getSupplierWise($supplier_id);

        $date = getDateTime();

        require ABSPATH . 'resources/stock/supplierWiseReportPDF.php';
    }

    public function productWisePDF()
    {
        $category_id = $_GET['category_id'] ?? '';
        $product_id = $_GET['product_id'] ?? '';
        $products = $this->productService->getProductWise($category_id, $product_id);

        $date = getDateTime();

        require ABSPATH . 'resources/stock/productWiseReportPDF.php';
    }
}
