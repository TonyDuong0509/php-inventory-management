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

    public function storeInvoiceDetails($categories, $paramsDetails, $invoice_id): int
    {
        global $mysqli;

        $count_category = $categories;

        for ($i = 0; $i < $count_category; $i++) {
            $dateDetails = $paramsDetails['date'];
            $invoice_id = $invoice_id;
            $category_id = $paramsDetails['category_id'][$i];
            $product_id = $paramsDetails['product_id'][$i];
            $selling_qty = $paramsDetails['selling_qty'][$i];
            $unit_price = $paramsDetails['unit_price'][$i];
            $selling_price = $paramsDetails['selling_price'][$i];
            $status = $paramsDetails['status'];
            $created_at = $paramsDetails['created_at'];
            $updated_at = $paramsDetails['updated_at'];

            $sql = "INSERT INTO invoice_details (date, invoice_id, category_id, product_id, selling_qty, unit_price, selling_price, status, created_at, updated_at)
                        VALUES ('$dateDetails', '$invoice_id', '$category_id', '$product_id', '$selling_qty', '$unit_price', '$selling_price', '$status', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) return $mysqli->insert_id;
        }
    }

    public function storeCustomer($customer_id, $paramsCustomer): int
    {
        global $mysqli;

        if ($customer_id == '0') {
            $name = $paramsCustomer['name'];
            $mobile_no = $paramsCustomer['mobile_no'];
            $email = $paramsCustomer['email'];
            $created_by = $paramsCustomer['created_by'];
            $updated_by = $paramsCustomer['updated_by'];
            $created_at = $paramsCustomer['created_at'];
            $updated_at = $paramsCustomer['updated_at'];

            $sql = "INSERT INTO customers (name, mobile_no, email, created_by, updated_by, created_at, updated_at)
                    VALUES ('$name', '$mobile_no', '$email', '$created_by', '$updated_by', '$created_at', '$updated_at')";

            if ($mysqli->query($sql) === true) {
                $last_id = $mysqli->insert_id;
            }
            return $last_id;
        } else {
            return $customer_id;
        }
    }

    public function storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails)
    {
        global $mysqli;

        $invoice_id = $invoice_id;
        $customer_id = $customer_id;
        $paid_status = $paramsPayment['paid_status'];
        $discount_amount = $paramsPayment['discount_amount'];
        $total_amount = $paramsPayment['estimated_amount'];
        $created_at = $paramsPayment['created_at'];
        $updated_at = $paramsPayment['updated_at'];

        if ($paid_status === 'full_paid') {
            $paid_amount = $paramsPayment['estimated_amount'];
            $due_amount = '0';
            $current_paid_amount = $paramsPayment['estimated_amount'];
        } elseif ($paid_status === 'full_due') {
            $paid_amount = '0';
            $due_amount = $paramsPayment['estimated_amount'];
            $current_paid_amount = '0';
        } elseif ($paid_status === 'partial_paid') {
            $paid_amount = $paramsPayment['paid_amount'];
            $due_amount = $paramsPayment['estimated_amount'] - $paramsPayment['paid_amount'];
            $current_paid_amount = $paid_amount;
        }

        $sql = "INSERT INTO payments (invoice_id, customer_id, paid_status, paid_amount, due_amount, total_amount, discount_amount, created_at, updated_at)
                VALUES ('$invoice_id', '$customer_id', '$paid_status', '$paid_amount', '$due_amount', '$total_amount', '$discount_amount', '$created_at', '$updated_at')";

        if ($mysqli->query($sql) === true) {
            $payment_id = $mysqli->insert_id;
        }

        $date = $paramsPaymentDetails['date'];
        $updated_by = $paramsPaymentDetails['updated_by'];

        $sql = "INSERT INTO payment_details (invoice_id, current_paid_amount, date, updated_by, created_at, updated_at)
                VALUES ('$invoice_id', '$current_paid_amount', '$date', '$updated_by', '$created_at', '$updated_at')";

        if ($mysqli->query($sql) === true) {
            $paymentDetails_id = $mysqli->insert_id;
        }
    }

    public function store(
        $paramsInvoice,
        $categories,
        $customer_id,
        $paramsDetails,
        $paramsCustomer,
        $paramsPayment,
        $paramsPaymentDetails
    ): bool {
        global $mysqli;

        $mysqli->begin_transaction();
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

            if ($mysqli->query($sql) === true) {
                $last_id = $mysqli->insert_id;
            }

            $this->storeInvoiceDetails($categories, $paramsDetails, $last_id);
            $customerId =  $this->storeCustomer($customer_id, $paramsCustomer);
            $this->storePayment($last_id, $customerId, $paramsPayment, $paramsPaymentDetails);
            $mysqli->commit();
            return true;
        } catch (Exception $error) {
            $mysqli->rollback();
            throw new Exception($error->getMessage());
        }
    }
}
