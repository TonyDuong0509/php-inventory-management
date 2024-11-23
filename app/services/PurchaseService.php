<?php

namespace App\Services;

use App\Repositories\PurchaseRepository;

class PurchaseService
{
    private $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function getAllPurchases()
    {
        return $this->purchaseRepository->fetchAll(null, 'id DESC');
    }

    public function getAllPendingPurchases()
    {
        $condition = "status = '0'";
        return $this->purchaseRepository->fetchAll($condition, 'created_at DESC');
    }

    public function store($params): int
    {
        return $this->purchaseRepository->store($params);
    }

    public function delete($id): bool
    {
        return $this->purchaseRepository->delete($id);
    }

    public function getById($id): object|bool
    {
        return $this->purchaseRepository->getById($id);
    }

    public function approveStatus(): bool
    {
        return $this->purchaseRepository->approveStatus();
    }
}
