<?php

namespace App\Repositories\Interface;

interface ProductRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null, $orderBy = null): array;
    public function getById($id);
    public function update($unit): object|bool;
    public function delete($id): bool;
    public function getCategory($supplier_id);
}
