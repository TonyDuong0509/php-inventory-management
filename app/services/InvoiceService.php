<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService
{
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function countAllInvoices()
    {
        return $this->invoiceRepository->fetchAll('*');
    }

    public function getAllInvoices()
    {
        $condition = "status = 1";
        return $this->invoiceRepository->fetchAll('*', $condition, 'date DESC');
    }

    public function getAllApprovalInvoices()
    {
        $condition = "status = 0";
        return $this->invoiceRepository->fetchAll('*', $condition, 'date DESC');
    }

    public function getInvoiceNo($fields, $condition, $orderBy)
    {
        return $this->invoiceRepository->fetchAll($fields, $condition, $orderBy);
    }

    public function store($paramsInvoice): int
    {
        return $this->invoiceRepository->store($paramsInvoice);
    }

    public function storeInvoiceDetails($paramsDetails, $invoice_id)
    {
        return $this->invoiceRepository->storeInvoiceDetails($paramsDetails, $invoice_id);
    }

    public function delete($id): bool
    {
        return $this->invoiceRepository->delete($id);
    }

    public function getById($id): object|bool
    {
        return $this->invoiceRepository->getById($id);
    }

    public function getAllInvoicesDetailsByInvoiceId($invoice_id)
    {
        $condition = "invoice_id = '$invoice_id'";
        return $this->invoiceRepository->fetchAllInvoicesDetails('*', $condition, null);
    }

    public function getDailyReport($start_date, $end_date)
    {
        $condition = "status = 1 AND date BETWEEN '$start_date' AND '$end_date'";
        return $this->invoiceRepository->fetchAll('*', $condition);
    }

    public function getInvoiceDetailsById($id)
    {
        return $this->invoiceRepository->getInvoiceDetailsById($id);
    }

    public function update($invoice): object|bool
    {
        return $this->invoiceRepository->update($invoice);
    }

    public function updateStatusInvoiceDetails($invoice_details)
    {
        return $this->invoiceRepository->updateStatusInvoiceDetails($invoice_details);
    }

    public function totalSelling($category_id, $product_id)
    {
        $condition = "category_id = $category_id AND product_id = $product_id AND status = '1'";
        return $this->invoiceRepository->fetchAllInvoicesDetails('SUM(selling_qty)', $condition);
    }
}
