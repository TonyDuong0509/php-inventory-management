<?php

namespace App\Controllers;

use App\Services\PaymentService;

class PaymentController
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
}
