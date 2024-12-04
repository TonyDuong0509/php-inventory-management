<?php

namespace App\Repositories\Interface;

interface PermissionsRepositoryInterface
{
    public function fetchAll($condition = null): array;
    public function store($params): int;
    public function getById($id): object|bool;
    public function update($permission): object|bool;
    public function delete($id): bool;
    public function getAllGuardName(): array;
    public function getByGuardName($guard_name): array;
}
