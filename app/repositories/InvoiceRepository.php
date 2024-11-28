<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
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
                while ($row = $result->fetch_assoc()) {
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

    public function storeInvoiceDetails($paramsDetails, $invoice_id)
    {
        global $mysqli;

        $dateDetails = $paramsDetails['date'];
        $invoice_id = $invoice_id;
        $category_id = $paramsDetails['category_id'];
        $product_id = $paramsDetails['product_id'];
        $selling_qty = $paramsDetails['selling_qty'];
        $unit_price = $paramsDetails['unit_price'];
        $selling_price = $paramsDetails['selling_price'];
        $status = $paramsDetails['status'];
        $created_at = $paramsDetails['created_at'];
        $updated_at = $paramsDetails['updated_at'];

        $sql = "INSERT INTO invoice_details (date, invoice_id, category_id, product_id, selling_qty, unit_price, selling_price, status, created_at, updated_at)
                        VALUES ('$dateDetails', '$invoice_id', '$category_id', '$product_id', '$selling_qty', '$unit_price', '$selling_price', '$status', '$created_at', '$updated_at')";

        if ($mysqli->query($sql) === true) {
            $last_id = $mysqli->insert_id;
        }
    }

    public function store($paramsInvoice): int
    {
        global $mysqli;

        try {

            $invoice_no = $paramsInvoice['invoice_no'];
            $date = $paramsInvoice['date'];
            $description = $paramsInvoice['description'];
            $status = $paramsInvoice['status'];
            $created_by = $paramsInvoice['created_by'];
            $updated_by = $paramsInvoice['updated_by'];
            $created_at = $paramsInvoice['created_at'];
            $updated_at = $paramsInvoice['updated_at'];

            $sql = "INSERT INTO invoices (invoice_no, date, description, status, created_by, updated_by, created_at, updated_at)
                    VALUES ('$invoice_no', '$date', '$description', '$status', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id): bool
    {
        try {
            global $mysqli;

            $sql = "DELETE FROM invoices
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
            $invoices = $this->fetchAll('*', $condition);
            return current($invoices);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAllInvoicesDetails($fields = '*', $condition = null, $orderBy = null): array|int
    {
        try {
            global $mysqli;

            $invoicesDetails = [];
            $sql = "SELECT $fields FROM invoice_details";
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
                    $invoiceDetails = new InvoiceDetails(
                        $row['id'],
                        $row['date'],
                        $row['invoice_id'],
                        $row['category_id'],
                        $row['product_id'],
                        $row['selling_qty'],
                        $row['unit_price'],
                        $row['selling_price'],
                        $row['status'],
                        $row['created_at'],
                        $row['updated_at']
                    );
                    $invoicesDetails[] = $invoiceDetails;
                };
            }

            return $invoicesDetails;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($invoice): object|bool
    {
        try {
            global $mysqli;

            $id = $invoice->getId();
            $invoice_no = $invoice->getInvoiceNo();
            $description = $invoice->getDescription();
            $status = $invoice->getStatus();
            $updated_by = $invoice->getUpdatedBy();
            $updated_at = $invoice->getUpdatedAt();
            $sql = "UPDATE invoices
                    SET invoice_no = '$invoice_no', description = '$description', status = '$status', updated_by = '$updated_by', updated_at = '$updated_at'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getInvoiceDetailsById($id): object|bool
    {
        try {
            $condition = "id = '$id' LIMIT 1";
            $invoice_details = $this->fetchAllInvoicesDetails('*', $condition);
            return current($invoice_details);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function updateStatusInvoiceDetails($invoice_details): object|bool
    {
        try {
            global $mysqli;

            $id = $invoice_details->getId();
            $status = $invoice_details->getStatus();
            $sql = "UPDATE invoice_details
                    SET status = '$status'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
