<?php

namespace App\Controllers;

use App\Services\ProductService;
use Exception;

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

    public function getStock()
    {
        header('Content-Type: application/json');

        $product_id = $_GET['product_id'] ?? '';

        if (empty($product_id)) {
            echo json_encode(['error' => 'Product ID is required']);
            exit;
        }

        $result = $this->productservice->getStock($product_id);

        if (empty($result)) {
            echo json_encode(['stock' => 0]);
            exit;
        }

        echo json_encode(['stock' => (int) $result[0]['quantity']]);
        exit;
    }
}
