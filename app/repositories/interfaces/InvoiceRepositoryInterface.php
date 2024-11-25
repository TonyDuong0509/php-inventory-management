<?php

namespace App\Repositories\Interface;

interface InvoiceRepositoryInterface
{
    public function fetchAll($fields = '*', $condition = null, $orderBy = null): array;
}
