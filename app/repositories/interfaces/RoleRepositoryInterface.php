<?php

namespace App\Repositories\Interface;

interface RoleRepositoryInterface
{
    public function fetchAll($condition = null): array;
    public function store($role): int;
    public function getById($id): object|bool;
    public function getByName($name): object|bool;
    public function update($role): object|bool;
    public function updatePermissions($role): bool;
    public function delete($id): bool;
}
