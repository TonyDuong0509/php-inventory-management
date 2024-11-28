<?php

namespace App\Repositories;

use App\Models\Purchase;
use App\Repositories\Interface\PurchaseRepositoryInterface;
use Exception;

class PurchaseRepository implements PurchaseRepositoryInterface
{
    public function fetchAll($condition = null, $orderBy = null, $fields = "*"): array|int
    {
        try {
            global $mysqli;

            $purchases = [];
            $sql = "SELECT $fields FROM purchases";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);

            if ($fields !== '*' && strpos($fields, 'SUM(') !== false) {
                $row = $result->fetch_assoc();
                return $row[array_key_first($row)] ?? 0;
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $purchase = new Purchase(
                        $row['id'],
                        $row['supplier_id'],
                        $row['category_id'],
                        $row['product_id'],
                        $row['purchase_no'],
                        $row['date'],
                        $row['description'],
                        $row['buying_qty'],
                        $row['unit_price'],
                        $row['buying_price'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $purchases[] = $purchase;
                };
            }

            return $purchases;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function store($params): int
    {
        try {
            global $mysqli;

            $date = $params['date'];
            $purchase_no = $params['purchase_no'];
            $supplier_id = $params['supplier_id'];
            $category_id = $params['category_id'];
            $product_id = $params['product_id'];
            $buying_qty = $params['buying_qty'];
            $unit_price = $params['unit_price'];
            $buying_price = $params['buying_price'];
            $description = $params['description'];
            $created_by = $params['created_by'];
            $updated_by = $params['updated_by'];
            $created_at = $params['created_at'];
            $updated_at = $params['updated_at'];

            $sql = "INSERT INTO purchases (date, purchase_no, supplier_id, category_id, product_id, buying_qty, unit_price, buying_price, description, created_by, updated_by, created_at, updated_at)
                    VALUES ('$date', '$purchase_no', '$supplier_id', '$category_id', '$product_id', '$buying_qty', '$unit_price', '$buying_price', '$description', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): bool
    {
        try {
            global $mysqli;

            $sql = "DELETE FROM purchases
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $purchases = $this->fetchAll($condition);
            return current($purchases);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function approveStatus($id): bool
    {
        try {
            global $mysqli;

            $sql = "UPDATE purchases
                    SET status = '1'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
