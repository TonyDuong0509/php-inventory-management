<?php

namespace App\Repositories\Interface;

interface CustomerRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null, $orderBy = null): array;
    public function getByEmail($email): object|bool;
    public function getById($id): object|bool;
    public function update($customer): object|bool;
    public function delete($id): bool;
}
