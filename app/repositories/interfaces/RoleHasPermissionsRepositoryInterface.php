<?php

namespace App\Repositories\Interface;

interface RoleHasPermissionsRepositoryInterface
{
    public function store($params): bool;
    public function getPermissionsByRoleId($roleId): array|bool;
    public function fetchAll($condition = null): array;
    public function removePermissions($roleId, $permissionsToRemove): bool;
    public function delete($id): bool;
    public function getPermissionssByRoleIdJoinTables($roleId): array|bool;
}
