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

    public function getAllInvoices()
    {
        return $this->invoiceRepository->fetchAll('*', null, 'id DESC');
    }

    public function getInvoiceNo($fields, $condition, $orderBy)
    {
        return $this->invoiceRepository->fetchAll($fields, $condition, $orderBy);
    }
}
