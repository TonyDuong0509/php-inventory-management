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

    public function store($params)
    {
        return $this->supplierRepository->store($params);
    }
}
