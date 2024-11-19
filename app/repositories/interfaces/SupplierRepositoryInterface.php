<?php

namespace App\Repositories\Interface;

interface SupplierRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null): array;
    public function getById($id): object | bool;
    public function update($supplier): object | bool;
    public function delete($id): bool;
}
