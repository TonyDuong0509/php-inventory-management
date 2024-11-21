<?php

namespace App\Repositories\Interface;

interface UnitRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null, $orderBy = null): array;
    public function getById($id): object|bool;
    public function update($unit): object|bool;
    public function delete($id): bool;
}
