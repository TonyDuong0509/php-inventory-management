<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interface\RoleRepositoryInterface;
use Exception;

class RoleRepository implements RoleRepositoryInterface
{
    public function fetchAll($condition = null): array
    {
        try {
            global $mysqli;

            $roles = [];
            $sql = "SELECT * FROM roles";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $role = new Role($row['id'], $row['name'], $row['permissions']);
                    $roles[] = $role;
                }
            }

            return $roles;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function store($params): int
    {
        try {
            global $mysqli;

            $name = $params['name'];
            $permissions = implode(',', $params['permissions']);

            $sql = "INSERT INTO roles (name, permissions)
                    VALUES ('$name', '$permissions')";
            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $roles = $this->fetchAll($condition);
            return current($roles);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByName($name): object|bool
    {
        try {
            $condition = "name = '$name'";
            $roles = $this->fetchAll($condition);
            return current($roles);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($role): object|bool
    {
        try {
            global $mysqli;

            $id = $role->getId();
            $name = $role->getName();
            $sql = "UPDATE roles
                    SET  name = '$name'
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function updatePermissions($role): bool
    {
        try {
            global $mysqli;

            $id = $role->getId();
            $permissions = $role->getPermissions();
            $permissions = implode(',', $role->getPermissions());
            $sql = "UPDATE roles
                    SET permissions = '$permissions'
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
            $sql = "DELETE FROM roles
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
            return false;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
