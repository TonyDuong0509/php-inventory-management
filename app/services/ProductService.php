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
        return $this->productRepository->fetchAll(null, 'id DESC');
    }

    public function getById($id): object
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
}