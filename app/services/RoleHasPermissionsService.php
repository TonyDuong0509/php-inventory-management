<?php

namespace App\Services;

use App\Repositories\RoleHasPermissionsRepository;

class RoleHasPermissionsService
{
    private $roleHasPermissionsRepository;

    public function __construct(RoleHasPermissionsRepository $roleHasPermissionsRepository)
    {
        $this->roleHasPermissionsRepository = $roleHasPermissionsRepository;
    }

    public function store($params): bool
    {
        return $this->roleHasPermissionsRepository->store($params);
    }

    public function getAllRoleHasPermissions(): array
    {
        return $this->roleHasPermissionsRepository->fetchAll();
    }

    public function getPermissionsByRoleId($roleId): array|bool
    {
        return $this->roleHasPermissionsRepository->getPermissionsByRoleId($roleId);
    }

    public function getPermissionssByRoleIdJoinTables($roleId): array|bool
    {
        return $this->roleHasPermissionsRepository->getPermissionssByRoleIdJoinTables($roleId);
    }

    public function removePermissions($roleId, $permissions): bool
    {
        return $this->roleHasPermissionsRepository->removePermissions($roleId, $permissions);
    }

    public function delete($id): bool
    {
        return $this->roleHasPermissionsRepository->delete($id);
    }

    public function checkPermission($requiredPermissions, $roleId)
    {

        $permissions = $this->roleHasPermissionsRepository->getPermissionssByRoleIdJoinTables((int) $roleId);
        $allowedPermissions = array_column($permissions, 'guard_name');
        if (!in_array($requiredPermissions, $allowedPermissions)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => "You don't have permission to access !"
            ];
            header("Location: /");
            exit;
        }
    }
}
