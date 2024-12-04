<?php

namespace App\Repositories;

use App\Models\RoleHasPermissions;
use App\Repositories\Interface\RoleHasPermissionsRepositoryInterface;
use Exception;

class RoleHasPermissionsRepository implements RoleHasPermissionsRepositoryInterface
{
    public function store($params): bool
    {
        try {
            global $mysqli;

            $role_id = $params['role_id'];
            $permission_ids = $params['permission_id'];

            $sql = "INSERT INTO role_has_permissions (role_id, permission_id)
                    VALUES ";
            $values = [];
            foreach ($permission_ids as $permission_id) {
                $values[] = "('$role_id', '$permission_id')";
            }

            $sql .= implode(", ", $values);
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null): array
    {
        try {
            global $mysqli;

            $roleHasPermissions = [];
            $sql = "SELECT * FROM role_has_permissions";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $role_has_permission = new RoleHasPermissions($row['role_id'], $row['permission_id']);
                    $roleHasPermissions[] = $role_has_permission;
                }
            }

            return $roleHasPermissions;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getPermissionsByRoleId($roleId): array|bool
    {
        try {
            $condition = "role_id = '$roleId'";
            return $this->fetchAll($condition);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getPermissionssByRoleIdJoinTables($roleId): array|bool
    {
        try {
            global $mysqli;

            $permissions = [];
            $sql = "SELECT p.* FROM permissions p
                    INNER JOIN role_has_permissions rp ON p.id = rp.permission_id
                    WHERE rp.role_id = '$roleId'";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $permissions[] = $row;
                }
            }
            return $permissions;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function removePermissions($roleId, $permissionsToRemove): bool
    {
        try {
            global $mysqli;

            $sql = "DELETE FROM role_has_permissions
                WHERE role_id = '$roleId'
                AND permission_id IN (" . implode(',', array_map('intval', $permissionsToRemove)) . ")";
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): bool
    {
        try {
            global $mysqli;

            $sql = "DELETE FROM role_has_permissions
                WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
