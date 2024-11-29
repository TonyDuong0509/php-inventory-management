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

    public function getPaymentDetailsByInvoiceId($invoice_id)
    {
        return $this->paymentRepository->getPaymentDetailsByInvoiceId($invoice_id);
    }

    public function storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails)
    {
        return $this->paymentRepository->storePayment($invoice_id, $customer_id, $paramsPayment, $paramsPaymentDetails);
    }

    public function getAllPaymentsWithStatus()
    {
        $condition = "paid_status IN ('full_due', 'partial_paid')";
        return $this->paymentRepository->fetchAll('*', $condition, null);
    }

    public function update($payment): object|bool
    {
        return $this->paymentRepository->update($payment);
    }

    public function updatePaymentDetails($paymentDetails): object|bool
    {
        return $this->paymentRepository->updatePaymentDetails($paymentDetails);
    }

    public function getPaidCustomer()
    {
        $condition = "paid_status != 'full_due'";
        return $this->paymentRepository->fetchAll('*', $condition);
    }

    public function getAllPaymentsCustomerCreditReport($customer_id)
    {
        $condition = "customer_id = '$customer_id' AND paid_status IN ('full_due', 'partial_due')";
        return $this->paymentRepository->fetchAll('*', $condition, null);
    }

    public function getAllPaymentsCustomerPaidReport($customer_id)
    {
        $condition = "customer_id = '$customer_id' AND paid_status != 'full_due'";
        return $this->paymentRepository->fetchAll('*', $condition);
    }
}
