<?php

namespace App\Services;

use App\Repositories\PermissionsRepository;

class PermissionsService
{
    private $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function getAllPermissions(): array
    {
        return $this->permissionsRepository->fetchAll();
    }

    public function store($param): int
    {
        return $this->permissionsRepository->store($param);
    }

    public function getById($id): object|bool
    {
        return $this->permissionsRepository->getById($id);
    }

    public function update($permission): object|bool
    {
        return $this->permissionsRepository->update($permission);
    }

    public function delete($id): bool
    {
        return $this->permissionsRepository->delete($id);
    }

    public function getAllGuardName(): array
    {
        return $this->permissionsRepository->getAllGuardName();
    }

    public function getByGuardName($guard_name): array
    {
        return $this->permissionsRepository->getByGuardName($guard_name);
    }
}
