<?php

namespace App\Repositories\Interface;

interface PurchaseRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null, $orderBy = null): array|int;
    public function getById($id): object|bool;
    // public function update($unit): object|bool;
    public function delete($id): bool;
    public function approveStatus($id): bool;
}
