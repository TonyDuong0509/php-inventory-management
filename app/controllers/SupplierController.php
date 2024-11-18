<?php

namespace App\Controllers;

use App\Services\SupplierService;

class SupplierController
{
    private $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function suppliersAll()
    {
        require ABSPATH . 'resources/supplier/allSuppliers.php';
    }

    public function supplierAdd()
    {
        require ABSPATH . 'resources/supplier/addSupplier.php';
    }

    public function supplierStore()
    {
        $name = $_POST['name'] ?? '';
        $mobile_no = $_POST['mobile_no'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';
        $created_by = 'Francis';

        $params = [
            'name' => $name,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'created_by' => $created_by,
        ];

        $this->supplierService->store($params);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
