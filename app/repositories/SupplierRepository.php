<?php

namespace App\Repositories;

use App\Repositories\Interface\SupplierRepositoryInterface;
use Exception;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function store($params)
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
            $created_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO suppliers (name, mobile_no, email, address, created_by, created_at)
                VALUES ('$supplierName', '$mobile_no', '$email', '$address', '$created_by', '$created_at')";

            if ($mysqli->query($sql) === true) {
                return $mysqli->insert_id;
            } else {
                throw new Exception('Database error: ' . $mysqli->error);
            }
        } catch (Exception $error) {
            return ['error' => true, 'message' => $error->getMessage()];
        }
    }
}
