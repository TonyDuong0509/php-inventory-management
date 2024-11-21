<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\Interface\UnitRepositoryInterface;
use Exception;

class UnitRepository implements UnitRepositoryInterface
{
    public function store($params): int
    {
        try {
            global $mysqli;

            $name = $params['name'] ?? '';
            $created_by = $params['created_by'] ?? '';
            $updated_by = $params['updated_by'] ?? '';
            $created_at = $params['created_at'] ?? '';
            $updated_at = $params['updated_at'] ?? '';

            $sql = "INSERT INTO units (name, created_by, updated_by, created_at, updated_at)
                    VALUES ('$name', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $units = [];
            $sql = "SELECT * FROM units";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $unit = new Unit(
                        $row['id'],
                        $row['name'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $units[] = $unit;
                };
            }

            return $units;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $units = $this->fetchAll($condition);
            return current($units);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($unit): object|bool
    {
        try {
            global $mysqli;

            $id = $unit->getId();
            $name = $unit->getName();
            $updated_at = $unit->getUpdatedAt();
            $updated_by = $unit->getUpdatedBy();

            $sql = "UPDATE units
                    SET name = '$name', updated_by = '$updated_by', updated_at = '$updated_at'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): bool
    {
        try {
            global $mysqli;

            $sql = "DELETE FROM units
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
