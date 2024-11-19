<?php

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{
    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function store($params): int
    {
        return $this->supplierRepository->store($params);
    }

    public function getAllSuppliers(): array
    {
        return $this->supplierRepository->fetchAll();
    }

    public function getById($id): object | bool
    {
        return $this->supplierRepository->getById($id);
    }

    public function update($supplier): object | bool
    {
        return $this->supplierRepository->update($supplier);
    }

    public function delete($id): bool
    {
        return $this->supplierRepository->delete($id);
    }
}
