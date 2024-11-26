<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->fetchAll('*', null, 'id DESC');
    }

    public function getByInvoiceId($invoice_id)
    {
        return $this->paymentRepository->getByInvoiceId($invoice_id);
    }

    public function storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails)
    {
        return $this->paymentRepository->storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails);
    }
}
