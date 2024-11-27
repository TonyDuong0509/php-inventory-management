<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interface\CustomerRepositoryInterface;
use Exception;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function store($params, $customer_id = null): int
    {
        try {
            global $mysqli;

            if ($customer_id) {
                if ($customer_id === '0') {
                    $customer_id = '0';
                } else {
                    return $customer_id;
                }
            }

            $name = $params['name'];
            $customer_image = $params['customer_image'] ?? '';
            $mobile_no = $params['mobile_no'];
            $email = $params['email'];
            $address = $params['address'] ?? '';
            $created_by = $params['created_by'];
            $updated_by = $params['updated_by'];
            $created_at = $params['created_at'];
            $updated_at = $params['updated_at'];

            $sql = "INSERT INTO customers (name, customer_image, mobile_no, email, address, created_by, updated_by, created_at, updated_at)
                    VALUES ('$name', '$customer_image', '$mobile_no', '$email', '$address', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $customers = [];
            $sql = "SELECT * FROM customers";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $customer = new Customer(
                        $row['id'],
                        $row['name'],
                        $row['customer_image'],
                        $row['mobile_no'],
                        $row['email'],
                        $row['address'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $customers[] = $customer;
                }
            }

            return $customers;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByEmail($email): object|bool
    {
        try {
            $condition = "email = '$email'";
            $customers = $this->fetchAll($condition, null);
            return current($customers);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $customers = $this->fetchAll($condition, null);
            return current($customers);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($customer): object|bool
    {
        try {
            global $mysqli;

            $id = $customer->getId();
            $name = $customer->getName();
            $mobile_no = $customer->getMobileNo();
            $address = $customer->getAddress();
            $customer_image = $customer->getCustomerImage();
            $updated_by = $customer->getUpdatedBy();
            $updated_at = $customer->getUpdatedAt();

            $sql = "UPDATE customers
                    SET name = '$name', mobile_no = '$mobile_no', address = '$address', 
                    customer_image = '$customer_image', updated_by = '$updated_by', updated_at = '$updated_at'
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

            $sql = "DELETE FROM customers
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
