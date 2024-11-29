<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SupplierService;
use App\Services\UnitService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class ProductController
{
    private $productService;
    private $supplierService;
    private $unitService;
    private $categoryService;
    private $userService;

    public function __construct(
        ProductService $productService,
        SupplierService $supplierService,
        UnitService $unitService,
        CategoryService $categoryService,
        UserService $userService,
    ) {
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->unitService = $unitService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function productsAll()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $products = $this->productService->getAllproducts();

        require ABSPATH . 'resources/product/allProducts.php';
    }

    public function productAdd()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $suppliers = $this->supplierService->getAllSuppliers();
        $units = $this->unitService->getAllUnits();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/product/addProduct.php';
    }

    public function productStore()
    {
        $id = $_SESSION['user']['id'] ?? '';

        $user = $this->userService->getById($id);

        if (
            empty($_POST['supplier_id']) ||
            empty($_POST['unit_id']) ||
            empty($_POST['category_id'])
        ) {
            $_SESSION['formData'] = [
                'name' => $_POST['name'],
                'supplier_id' => $_POST['supplier_id'],
                'unit_id' => $_POST['unit_id'],
                'category_id' => $_POST['category_id'],
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Please select fields'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $name = $_POST['name'] ?? '';
        $supplier_id = $_POST['supplier_id'];
        $unit_id = $_POST['unit_id'];
        $category_id = $_POST['category_id'];
        $created_by = $user->getId();
        $updated_by = $user->getId();
        $created_at = getDateTime();
        $updated_at = getDateTime();

        $params = [
            'name' => $name,
            'supplier_id' => $supplier_id,
            'unit_id' => $unit_id,
            'category_id' => $category_id,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        $result = $this->productService->store($params);

        if ($result === -1) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Created product failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Created product successfully'
        ];
        header("Location: /all-products");
        exit;
    }

    public function productEdit($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $product = $this->productService->getById($id);
        $suppliers = $this->supplierService->getAllSuppliers();
        $units = $this->unitService->getAllUnits();
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/product/editProduct.php';
    }

    public function productUpdate()
    {
        $id = $_SESSION['user']['id'] ?? '';
        $user = $this->userService->getById($id);

        $productId = $_POST['productId'];
        $product = $this->productService->getById($productId);

        if (!$product) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This product is not exist, please try again'
            ];
            header("Location: /all-products");
            exit;
        }

        $supplier_id = $_POST['supplier_id'] ?? '';
        $unit_id = $_POST['unit_id'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $updated_by = $user->getId();
        $updated_at = getDateTime();

        $product->setSupplierId($supplier_id);
        $product->setUnitId($unit_id);
        $product->setCategoryId($category_id);
        $product->setName($name);
        $product->setUpdatedBy($updated_by);
        $product->setUpdatedAt($updated_at);

        $result = $this->productService->update($product);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Updated product failed'
            ];
            header("Location: /edit-product/$productId");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated product successfully'
        ];
        header("Location: /edit-product/$productId");
        exit;
    }

    public function productDelete($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $product = $this->productService->getById($id);

        if (!$product) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This product is not exist, please try again'
            ];
            header("Location: /all-products");
            exit;
        }

        $result = $this->productService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Deleted product failed'
            ];
            header("Location: /all-products");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted product successfully'
        ];
        header("Location: /all-products");
        exit;
    }
}
