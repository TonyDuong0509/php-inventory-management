<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interface\SupplierRepositoryInterface;
use Exception;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function store($params): int
    {
        global $mysqli;

        try {
            if (!isset($params['name'], $params['mobile_no'], $params['email'], $params['address'])) {
                throw new Exception('Missing required fields');
            }

            $supplierName = $mysqli->real_escape_string($params['name']);
            $mobile_no = $mysqli->real_escape_string($params['mobile_no']);
            $email = $mysqli->real_escape_string($params['email']);
            $address = $mysqli->real_escape_string($params['address']);
            $created_by = $mysqli->real_escape_string($params['created_by']);;
            $created_at = date('Y-m-d');

            $sql = "INSERT INTO suppliers (name, mobile_no, email, address, created_by, created_at)
                VALUES ('$supplierName', '$mobile_no', '$email', '$address', '$created_by', '$created_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null): array
    {
        try {
            global $mysqli;

            $suppliers = [];
            $sql = "SELECT * FROM suppliers";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $supplier = new Supplier(
                        $row['id'],
                        $row['name'],
                        $row['mobile_no'],
                        $row['email'],
                        $row['address'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $suppliers[] = $supplier;
                };

                return $suppliers;
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        $suppliers = [];
        $condition = "id = '$id'";
        $suppliers = $this->fetchAll($condition);
        return current($suppliers);
    }

    public function update($supplier): object|bool
    {
        global $mysqli;

        try {
            $id = $supplier->getId();
            $name = $mysqli->real_escape_string($supplier->getName());
            $mobile_no = $mysqli->real_escape_string($supplier->getMobileNo());
            $address = $mysqli->real_escape_string($supplier->getAddress());
            $updated_by = $mysqli->real_escape_string($supplier->getUpdatedBy());
            $updated_at = $supplier->getUpdatedAt();

            $sql = "UPDATE suppliers
                    SET name = '$name', mobile_no = '$mobile_no', address = '$address', updated_by = '$updated_by', updated_at = '$updated_at'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): bool
    {
        global $mysqli;

        try {
            $sql = "DELETE FROM suppliers
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
