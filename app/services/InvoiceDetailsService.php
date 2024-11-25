<?php

namespace App\Services;

use App\Repositories\InvoiceDetailsRepository;

class InvoiceDetailsService
{
    private $invoiceDetailsRepository;

    public function __construct(InvoiceDetailsRepository $invoiceDetailsRepository)
    {
        $this->invoiceDetailsRepository = $invoiceDetailsRepository;
    }
}
