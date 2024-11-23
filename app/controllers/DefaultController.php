<?php

namespace App\Controllers;

use App\Services\ProductService;

class DefaultController
{
    private $productservice;

    public function __construct(ProductService $productService)
    {
        $this->productservice = $productService;
    }

    public function getCategory()
    {
        header('Content-Type: application/json');
        $supplier_id = $_GET['supplier_id'] ?? '';

        if (empty($supplier_id)) {
            echo json_encode(['error' => 'Supplier ID is required']);
            exit;
        }

        $allCategories = $this->productservice->getCategory($supplier_id);
        echo json_encode($allCategories);
        exit;
    }

    public function getProduct()
    {
        header('Content-Type: application/json');

        $category_id = $_GET['category_id'] ?? '';

        if (empty($category_id)) {
            echo json_encode(['error' => 'Supplier ID is required']);
            exit;
        }

        $allProducts = $this->productservice->getAllProductsByCategoryId($category_id);

        if (empty($allProducts)) {
            echo json_encode([]);
            exit;
        }

        echo json_encode($allProducts);
        exit;
    }
}
