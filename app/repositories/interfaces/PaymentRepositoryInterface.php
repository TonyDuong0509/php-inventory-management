<?php

namespace App\Repositories\Interface;

interface PaymentRepositoryInterface
{
    public function getByInvoiceId($invoice_id): object|bool;
    public function fetchAll($fields, $condition = null, $orderBy = null): array;
    public function storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails);
    public function fetchAllPaymentsDetails($fields, $condition = null, $orderBy = null): array;
    public function update($payment): object|bool;
    public function updatePaymentDetails($paymentDetails): object|bool;
}
