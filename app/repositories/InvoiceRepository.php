<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Interface\InvoiceRepositoryInterface;
use Exception;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function fetchAll($fields = '*', $condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $invoices = [];
            $sql = "SELECT $fields FROM invoices";
            if ($condition) {
                $sql .= " WHERE $condition";
            }
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc) {
                    $invoice = new Invoice(
                        $row['id'],
                        $row['invoice_no'],
                        $row['date'],
                        $row['description'],
                        $row['status'],
                        $row['created_by'],
                        $row['updated_by'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $invoices[] = $invoice;
                }
            }

            return $invoices;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
