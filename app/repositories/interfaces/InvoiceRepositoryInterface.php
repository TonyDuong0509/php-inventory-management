<?php

namespace App\Repositories\Interface;

interface InvoiceRepositoryInterface
{
    public function fetchAll($fields = '*', $condition = null, $orderBy = null): array;
    public function store($paramsInvoice, $categories, $customer_id, $paramsDetails, $paramsCustomer, $paramsPayment, $paramsPaymentDetails): bool;
    public function storeInvoiceDetails($categories, $paramsDetails, $invoice_id): int;
    public function storeCustomer($customer_id, $paramsCustomer): int;
    public function storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails);
}
