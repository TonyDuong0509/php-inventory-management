<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\InvoiceService;


class InvoiceController
{
    private $invoiceService;
    private $categoryService;
    private $customerService;

    public function __construct(
        InvoiceService $invoiceService,
        CategoryService $categoryService,
        CustomerService $customerService,
    ) {
        $this->invoiceService = $invoiceService;
        $this->categoryService = $categoryService;
        $this->customerService = $customerService;
    }

    public function invoicesAll()
    {
        $invoices = $this->invoiceService->getAllInvoices();

        require ABSPATH . 'resources/invoice/allInvoices.php';
    }

    public function invoiceAdd()
    {
        $categories = $this->categoryService->getAllCategories();
        $invoice_data = $this->invoiceService->getInvoiceNo('*', null, 'id DESC LIMIT 1');
        if ($invoice_data == null) {
            $fistReg = '0';
            $invoice_no = $fistReg + 1;
        } else {
            $invoice_data = $this->invoiceService->getInvoiceNo('invoice_no', null, 'id DESC LIMIT 1');
            $invoice_no = $invoice_data + 1;
        }

        $date = date('Y-m-d');

        $customers = $this->customerService->getAllCustomers();

        require ABSPATH . 'resources/invoice/addInvoice.php';
    }
}
