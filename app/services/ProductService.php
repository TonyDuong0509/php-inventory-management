<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store($params): int
    {
        return $this->productRepository->store($params);
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->fetchAll('*', null, 'id DESC');
    }

    public function getStock($product_id): array
    {
        $condition = "id = $product_id LIMIT 1";
        return $this->productRepository->fetchAllForStockQuantity($condition, null);
    }

    public function getAllProductsByCategoryId($category_id): array
    {
        $condition = "category_id = '$category_id'";
        return $this->productRepository->getAllProductsByCategoryId($condition);
    }

    public function getById($id): object|bool
    {
        return $this->productRepository->getById($id);
    }

    public function update($product): object|bool
    {
        return $this->productRepository->update($product);
    }

    public function delete($id): bool
    {
        return $this->productRepository->delete($id);
    }

    public function getCategory($supplier_id)
    {
        return $this->productRepository->selectCategoryWhereSupplier($supplier_id, 'category_id DESC');
    }
}
