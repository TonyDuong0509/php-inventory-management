<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
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

            $sql = "INSERT INTO categories (name, created_by, updated_by, created_at, updated_at)
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

            $categories = [];
            $sql = "SELECT * FROM categories";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $category = new Category(
                        $row['id'],
                        $row['name'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $categories[] = $category;
                };
            }

            return $categories;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $categories = $this->fetchAll($condition);
            return current($categories);
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

            $sql = "UPDATE categories
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

            $sql = "DELETE FROM categories
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
