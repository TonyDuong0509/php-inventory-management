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

    public function approveStatus($id): bool
    {
        return $this->purchaseRepository->approveStatus($id);
    }

    public function totalBuying($category_id, $product_id)
    {
        $condition = "category_id = $category_id AND product_id = $product_id AND status = 1";
        return $this->purchaseRepository->fetchAll($condition, null, 'SUM(buying_qty)');
    }

    public function dailyPurchaseReport($start_date, $end_date)
    {
        $condition = "status = '1' AND date BETWEEN '$start_date' AND '$end_date'";
        return $this->purchaseRepository->fetchAll($condition, null);
    }
}
