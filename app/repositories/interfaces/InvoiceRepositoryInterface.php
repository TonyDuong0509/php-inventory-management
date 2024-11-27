<?php

namespace App\Repositories\Interface;

interface InvoiceRepositoryInterface
{
    public function fetchAll($fields = '*', $condition = null, $orderBy = null): array;
    public function store($paramsInvoice): int;
    public function storeInvoiceDetails($paramsDetails, $invoice_id);
    public function delete($id): bool;
    public function getById($id): object|bool;
    public function getInvoiceDetailsById($id): object|bool;
    public function fetchAllInvoicesDetails($fields = '*', $condition = null, $orderBy = null): array;
    public function update($invoice): object|bool;
}
