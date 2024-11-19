<?php

namespace App\Controllers;

use App\Services\SupplierService;
use App\Services\UserService;

class SupplierController
{
    private $supplierService;
    private $userService;

    public function __construct(
        SupplierService $supplierService,
        UserService $userService
    ) {
        $this->supplierService = $supplierService;
        $this->userService = $userService;
    }

    public function suppliersAll(): void
    {
        $suppliers = $this->supplierService->getAllSuppliers();

        require ABSPATH . 'resources/supplier/allSuppliers.php';
    }

    public function supplierAdd(): void
    {
        require ABSPATH . 'resources/supplier/addSupplier.php';
    }

    public function supplierStore(): void
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Please login to access'
            ];
            header("Location: /login-form");
            exit;
        }

        $id = $_SESSION['user']['id'];

        $user = $this->userService->getById($id);

        $name = $_POST['name'] ?? '';
        $mobile_no = $_POST['mobile_no'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';
        $created_by = $user->getEmail();

        $params = [
            'name' => $name,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'created_by' => $created_by,
        ];

        $this->supplierService->store($params);

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Create supplier successfully'
        ];
        header("Location: /all-suppliers");
        exit;
    }

    public function supplierEdit($id): void
    {
        $supplier = $this->supplierService->getById($id);
        if (!$supplier) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Supplier is not exist'
            ];
            header("Location: /all-suppliers");
            exit;
        }

        require ABSPATH . 'resources/supplier/editSupplier.php';
    }

    public function supplierUpdate(): void
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Please login to access'
            ];
            header("Location: /login-form");
            exit;
        }

        $id = $_SESSION['user']['id'];
        $user = $this->userService->getById($id);

        $supplierId = $_POST['supplierId'] ?? '';
        $name = $_POST['name'] ?? '';
        $mobile_no = $_POST['mobile_no'] ?? '';
        $address = $_POST['address'] ?? '';

        $supplier = $this->supplierService->getById($supplierId);
        $supplier->setName($name);
        $supplier->setMobileNo($mobile_no);
        $supplier->setAddress($address);
        $supplier->setUpdatedBy($user->getEmail());
        $supplier->setUpdatedAt(date('Y-m-d'));

        if (!$this->supplierService->update($supplier)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Update supplier failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Update supplier successfully'
        ];
        header("Location: /edit-supplier/$supplierId");
        exit;
    }

    public function supplierDelete($id): void
    {
        if (!$this->supplierService->delete($id)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Delete supplier failed'
            ];
        }

        header("Location: /all-suppliers");
        exit;
    }
}
