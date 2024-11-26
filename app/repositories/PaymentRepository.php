<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Interface\PaymentRepositoryInterface;
use Exception;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function fetchAll($fields, $condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $payments = [];
            $sql = "SELECT $fields FROM payments";
            if ($condition) {
                $sql .= " WHERE $condition";
            };
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            };

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $payment = new Payment($row['id'], $row['invoice_id'], $row['customer_id'], $row['paid_status'], $row['paid_amount'], $row['due_amount'], $row['total_amount'], $row['discount_amount'], $row['created_at'], $row['updated_at']);
                    $payments[] = $payment;
                };
            }
            return $payments;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByInvoiceId($invoice_id): object|bool
    {
        try {
            $condition = "invoice_id = $invoice_id";
            $payments = $this->fetchAll('*', $condition);
            return current($payments);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
