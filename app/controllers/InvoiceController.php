<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\InvoiceService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class InvoiceController
{
    private $invoiceService;
    private $categoryService;
    private $customerService;
    private $userService;

    public function __construct(
        InvoiceService $invoiceService,
        CategoryService $categoryService,
        CustomerService $customerService,
        UserService $userService,
    ) {
        $this->invoiceService = $invoiceService;
        $this->categoryService = $categoryService;
        $this->customerService = $customerService;
        $this->userService = $userService;
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
            $invoice_no = count($invoice_data) + 1;
        }

        $date = date('Y-m-d');

        $customers = $this->customerService->getAllCustomers();

        require ABSPATH . 'resources/invoice/addInvoice.php';
    }

    public function invoiceStore()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        if (!$user) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'User is not exist'
            ];
            header("Location: /");
            exit;
        }

        $category_id = $_POST['category_id'] ?? '';
        $paid_amount = $_POST['paid_amount'] ?? '';
        $estimated_amount = $_POST['estimated_amount'] ?? '';

        if ($category_id === '' || empty($category_id)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Sorry you do not select any item'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            if (($paid_amount > $estimated_amount)) {
                $_SESSION['toastrNotify'] = [
                    'alert-type' => 'error',
                    'message' => 'Sorry Paid amount is maximum the total price'
                ];
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                $paramsInvoice = [
                    'invoice_no' => $_POST['invoice_no'],
                    'date' => $_POST['date'],
                    'description' => $_POST['description'],
                    'status' => '0',
                    'created_by' => $user->getId(),
                    'updated_by' => $user->getId(),
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $categories = count($_POST['category_id']);

                $customer_id = $_POST['customer_id'];

                $paramsDetails = [
                    'date' => $_POST['date'],
                    'category_id' => $_POST['category_id'],
                    'product_id' => $_POST['product_id'],
                    'selling_qty' => $_POST['selling_qty'],
                    'unit_price' => $_POST['unit_price'],
                    'selling_price' => $_POST['selling_price'],
                    'status' => '0',
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $existingCustomerEmail = $this->customerService->getByEmail($_POST['email']);
                if ($existingCustomerEmail) {
                    $_SESSION['toastrNotify'] = [
                        'alert-type' => 'error',
                        'message' => 'This customer email is exist, please try another email'
                    ];
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                $paramsCustomer = [
                    'name' => $_POST['name'],
                    'mobile_no' => $_POST['mobile_no'],
                    'email' => $_POST['email'],
                    'created_by' => $user->getId(),
                    'updated_by' => $user->getId(),
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $paramsPayment = [
                    'paid_status' => $_POST['paid_status'],
                    'paid_amount' => $_POST['paid_amount'],
                    'discount_amount' => $_POST['discount_amount'],
                    'estimated_amount' => $_POST['estimated_amount'],
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $paramsPaymentDetails = [
                    'date' => $_POST['date'],
                    'updated_by' => $user->getId()
                ];

                $this->invoiceService->store($paramsInvoice, $categories, $customer_id, $paramsDetails, $paramsCustomer, $paramsPayment, $paramsPaymentDetails);

                $_SESSION['toastrNotify'] = [
                    'alert-type' => 'success',
                    'message' => 'Create invoice successfully'
                ];
                header("Location: /all-invoices");
                exit;
            }
        }
    }
}
