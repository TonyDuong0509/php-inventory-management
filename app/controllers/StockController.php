<?php

namespace App\Controllers;

use App\Services\ProductService;

use function Utils\Functions\getDateTime;

class StockController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function stockReport()
    {
        $products = $this->productService->getStockReport();
        require ABSPATH . 'resources/stock/stockReport.php';
    }

    public function stockReportPDF()
    {
        $products = $this->productService->getStockReport();
        $date = getDateTime();

        require ABSPATH . 'resources/stock/stockReportPDF.php';
    }
}
