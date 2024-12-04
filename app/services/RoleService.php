<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles(): array
    {
        return $this->roleRepository->fetchAll();
    }

    public function store($param): int
    {
        return $this->roleRepository->store($param);
    }

    public function getById($id): object|bool
    {
        return $this->roleRepository->getById($id);
    }

    public function getByName($name): object|bool
    {
        return $this->roleRepository->getByName($name);
    }

    public function update($role): object|bool
    {
        return $this->roleRepository->update($role);
    }

    public function delete($id): bool
    {
        return $this->roleRepository->delete($id);
    }

    public function updatePermissions($role): bool
    {
        return $this->roleRepository->updatePermissions($role);
    }
}
