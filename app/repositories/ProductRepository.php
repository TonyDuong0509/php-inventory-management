<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;
use Exception;

class ProductRepository implements ProductRepositoryInterface
{
    public function store($params): int
    {
        try {
            global $mysqli;

            $name = $params['name'] ?? '';
            $supplier_id = $params['supplier_id'] ?? '';
            $unit_id = $params['unit_id'] ?? '';
            $category_id = $params['category_id'] ?? '';
            $created_by = $params['created_by'] ?? '';
            $updated_by = $params['updated_by'] ?? '';
            $created_at = $params['created_at'] ?? '';
            $updated_at = $params['updated_at'] ?? '';

            $sql = "INSERT INTO products (name, supplier_id, unit_id, category_id, created_by, updated_by, created_at, updated_at)
                    VALUES ('$name', '$supplier_id', '$unit_id', '$category_id', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $products = [];
            $sql = "SELECT * FROM products";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product = new Product(
                        $row['id'],
                        $row['supplier_id'],
                        $row['unit_id'],
                        $row['category_id'],
                        $row['name'],
                        $row['quantity'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $products[] = $product;
                };
            }
            return $products;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getAllProductsByCategoryId($condition = null): array
    {
        try {
            global $mysqli;

            $products = [];
            $sql = "SELECT * FROM products";
            if ($condition) {
                $sql .= " WHERE $condition";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                    ];
                };
            }
            return $products;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function selectCategoryWhereSupplier($supplier_id, $orderBy = null)
    {
        try {
            global $mysqli;

            $categories = [];
            $sql = "SELECT p.category_id, c.name
                    FROM products p 
                    JOIN categories c ON p.category_id = c.id
                    WHERE supplier_id = '$supplier_id'
                    GROUP BY p.category_id, c.name";
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categories[] = [
                        'category_id' => $row['category_id'],
                        'name' => $row['name']
                    ];
                };
            }

            return $categories;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        $products = [];
        $condition = "id = '$id'";
        $products = $this->fetchAll($condition, null);
        return current($products);
    }

    public function update($product): object|bool
    {
        try {
            global $mysqli;

            $id = $product->getId();
            $supplier_id = $product->getSupplierId();
            $unit_id = $product->getUnitId();
            $category_id = $product->getCategoryId();
            $name = $product->getName();
            $quantity = $product->getQuantity();
            $updated_at = $product->getUpdatedAt();
            $updated_by = $product->getUpdatedBy();

            $sql = "UPDATE products
                    SET supplier_id = '$supplier_id', unit_id = '$unit_id', 
                    category_id = '$category_id', name = '$name', quantity = '$quantity', updated_by = '$updated_by', 
                    updated_at = '$updated_at'
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

            $sql = "DELETE FROM products
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getCategory($supplier_id)
    {
        try {
            global $mysqli;

            $sql = "SELECT category_id
                    FROM products
                    WHERE supplier_id = $supplier_id
                    GROUP BY category_id";

            if ($mysqli->query($sql) === true) {
                return $sql;
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
