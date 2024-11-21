<?php

namespace App\Repositories\Interface;

interface CategoryRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null, $orderBy = null): array;
    public function getById($id): object|bool;
    public function update($unit): object|bool;
    public function delete($id): bool;
}
