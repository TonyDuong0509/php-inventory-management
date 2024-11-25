<?php

namespace App\Services;

use App\Repositories\PaymentDetailsRepository;

class PaymentDetailsService
{
    private $paymentDetailsRepository;

    public function __construct(PaymentDetailsRepository $paymentDetailsRepository)
    {
        $this->paymentDetailsRepository = $paymentDetailsRepository;
    }
}
