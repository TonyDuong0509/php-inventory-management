<?php

namespace App\Repositories;

use App\Models\Permissions;
use App\Repositories\Interface\PermissionsRepositoryInterface;
use Exception;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    public function fetchAll($condition = null): array
    {
        try {
            global $mysqli;

            $permissions = [];
            $sql = "SELECT * FROM permissions";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $permission = new Permissions($row['id'], $row['name'], $row['guard_name']);
                    $permissions[] = $permission;
                }
            }

            return $permissions;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function store($params): int
    {
        try {
            global $mysqli;

            $name = $params['name'];
            $guard_name = $params['guard_name'];

            $sql = "INSERT INTO permissions (name, guard_name)
                    VALUES ('$name', '$guard_name')";
            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $permissions = $this->fetchAll($condition);
            return current($permissions);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($permission): object|bool
    {
        try {
            global $mysqli;

            $id = $permission->getId();
            $name = $permission->getName();
            $guard_name = $permission->getGuardName();
            $sql = "UPDATE permissions
                    SET  name = '$name', guard_name = '$guard_name'
                    WHERE id = '$id'";
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
            $sql = "DELETE FROM permissions
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getAllGuardName(): array
    {
        try {
            global $mysqli;

            $permissionsGroup = array();
            $sql = "SELECT DISTINCT guard_name FROM permissions";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $permissionsGroup[] = $row;
                }
            }
            return $permissionsGroup;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByGuardName($guard_name): array
    {
        try {
            $condition = "guard_name = '$guard_name'";
            return $this->fetchAll($condition);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
