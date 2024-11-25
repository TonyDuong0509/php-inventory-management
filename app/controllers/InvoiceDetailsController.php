<?php

namespace App\Controllers;

use App\Services\InvoiceDetailsService;

class InvoiceDetailsController
{
    private $invoiceDetailsService;

    public function __construct(InvoiceDetailsService $invoiceDetailsService)
    {
        $this->invoiceDetailsService = $invoiceDetailsService;
    }
}
