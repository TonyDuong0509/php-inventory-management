<?php

namespace App\Controllers;

use App\Services\PaymentDetailsService;

class PaymentDetailsController
{
    private $paymentDetailsService;

    public function __construct(PaymentDetailsService $paymentDetailsService)
    {
        $this->paymentDetailsService = $paymentDetailsService;
    }
}
