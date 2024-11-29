<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Repositories\Interface\PaymentRepositoryInterface;
use Exception;

use function PHPSTORM_META\type;

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

    public function fetchAllPaymentsDetails($fields, $condition = null, $orderBy = null): array
    {
        try {
            global $mysqli;

            $payments_details = [];
            $sql = "SELECT $fields FROM payment_details";
            if ($condition) {
                $sql .= " WHERE $condition";
            };
            if ($orderBy) {
                $sql .= " ORDER BY $orderBy";
            };

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $payment_details = new PaymentDetails($row['id'], $row['invoice_id'], $row['current_paid_amount'], $row['date'],  $row['updated_by'], $row['created_at'], $row['updated_at']);
                    $payments_details[] = $payment_details;
                };
            }
            return $payments_details;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getPaymentDetailsByInvoiceId($invoice_id): object|bool
    {
        try {
            $condition = "invoice_id = $invoice_id LIMIT 1";
            $payment_details = $this->fetchAllPaymentsDetails('*', $condition);
            return current($payment_details);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByInvoiceId($invoice_id): object|bool
    {
        try {
            $condition = "invoice_id = $invoice_id LIMIT 1";
            $payments = $this->fetchAll('*', $condition);
            return current($payments);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
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
            $paid_amount = $total_amount;
            $due_amount = '0';
            $current_paid_amount = $total_amount;
        } elseif ($paid_status === 'full_due') {
            $paid_amount = '0';
            $due_amount = $total_amount;
            $current_paid_amount = '0';
        } elseif ($paid_status === 'partial_paid') {
            $paid_amount = $paramsPayment['paid_amount'];
            $due_amount = $total_amount - $paid_amount;
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

    public function update($payment): object|bool
    {
        try {
            global $mysqli;

            $id = $payment->getId();
            $invoice_id = $payment->getInvoiceId();
            $customer_id = $payment->getCustomerId();
            $paid_status = $payment->getPaidStatus();
            $paid_amount = $payment->getPaidAmount();
            $due_amount = $payment->getDueAmount();
            $total_amount = $payment->getTotalAmount();
            $discount_amount = $payment->getDiscountAmount();
            $updated_at = $payment->getUpdatedAt();

            $sql = "UPDATE payments
                    SET invoice_id = '$invoice_id', customer_id = '$customer_id', paid_status = '$paid_status', paid_amount = '$paid_amount', due_amount = '$due_amount', total_amount = '$total_amount', discount_amount = '$discount_amount', updated_at = '$updated_at'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function updatePaymentDetails($paymentDetails): object|bool
    {
        try {
            global $mysqli;

            $id = $paymentDetails->getId();
            $invoice_id = $paymentDetails->getInvoiceId();
            $current_paid_amount = $paymentDetails->getCurrentPaidAmount();
            $date = $paymentDetails->getDate();
            $updated_by = $paymentDetails->getUpdatedBy();
            $created_at = $paymentDetails->getCreatedAt();
            $updated_at = $paymentDetails->getUpdatedAt();

            $sql = "UPDATE payment_details
                    SET invoice_id = '$invoice_id', current_paid_amount = '$current_paid_amount', date = '$date', updated_by = '$updated_by', created_at = '$created_at', updated_at = '$updated_at'
                    WHERE id = '$id'";

            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
