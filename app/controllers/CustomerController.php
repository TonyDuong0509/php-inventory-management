<?php

namespace App\Controllers;

use App\Services\CustomerService;
use App\Services\InvoiceService;
use App\Services\PaymentService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;
use function Utils\Functions\handleImage;

class CustomerController
{
    private $customerService;
    private $userService;
    private $paymentService;
    private $invoiceService;

    public function __construct(
        CustomerService $customerService,
        UserService $userService,
        PaymentService $paymentService,
        InvoiceService $invoiceService,
    ) {
        $this->customerService = $customerService;
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->invoiceService = $invoiceService;
    }

    public function customersAll()
    {
        $customers = $this->customerService->getAllCustomers();

        require ABSPATH . 'resources/customer/allCustomers.php';
    }

    public function customerAdd()
    {
        require ABSPATH . 'resources/customer/addCustomer.php';
    }

    public function customerStore()
    {
        $id = $_SESSION['user']['id'] ?? '';

        $user = $this->userService->getById($id);

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $mobile_no = $_POST['mobile_no'] ?? '';
        $address = $_POST['address'] ?? '';
        $created_by = $user->getId();
        $updated_by = $user->getId();
        $created_at = getDateTime();
        $updated_at = getDateTime();

        if ($this->customerService->getByEmail($email)) {
            $_SESSION['formData'] = [
                'name' => $name,
                'mobile_no' => $mobile_no,
                'email' => $email,
                'address' => $address,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Email is exist, please try another email'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $customer_image = handleImage('customer', 'customer_image');


        $params = [
            'name' => $name,
            'customer_image' => $customer_image,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];



        $response = $this->customerService->store($params);

        if ($response === -1) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Create customer failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Create customer successfully'
        ];
        header("Location: /all-customers");
        exit;
    }

    public function customerEdit($id)
    {
        $customer = $this->customerService->getById($id);

        if (!$customer) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Customer is not exist'
            ];
            header("Location: /all-customers");
            exit;
        }

        require ABSPATH . 'resources/customer/editCustomer.php';
    }

    public function customerUpdate()
    {
        $id = $_SESSION['user']['id'] ?? '';
        $old_image = $_POST['old_image'] ?? '';

        $user = $this->userService->getById($id);

        $customerId = $_POST['customerId'] ?? '';

        $customer = $this->customerService->getById($customerId);

        if (!$customer) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Customer is not exist'
            ];
            header("Location: /all-customers");
            exit;
        }

        $name = $_POST['name'] ?? '';
        $mobile_no = $_POST['mobile_no'] ?? '';
        $address = $_POST['address'] ?? '';
        $updated_by = $user->getId();
        $updated_at = getDateTime();
        $customer_image = "";

        if ($_FILES['customer_image']['name']) {
            $customer_image = handleImage('customer', 'customer_image', $old_image);
        } else {
            $customer_image = $old_image;
        }

        $customer->setName($name);
        $customer->setMobileNo($mobile_no);
        $customer->setAddress($address);
        $customer->setUpdatedBy($updated_by);
        $customer->setUpdatedAt($updated_at);
        $customer->setCustomerImage($customer_image);


        $result = $this->customerService->update($customer);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Update customer failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Update customer successfully'
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function customerDelete($id)
    {
        $customer = $this->customerService->getById($id);

        if (!$customer) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Customer is not exist'
            ];
            header("Location: /all-customers");
            exit;
        }

        unlink($customer->getCustomerImage());

        $result = $this->customerService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Delete customer failed'
            ];
            header("Location: /all-customers");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted customer successfully'
        ];
        header("Location: /all-customers");
        exit;
    }

    public function creditCustomer()
    {
        $payments = $this->paymentService->getAllPaymentsWithStatus();

        require ABSPATH . 'resources/customer/creditCustomer.php';
    }

    public function creditCustomerPrintPDF()
    {
        $payments = $this->paymentService->getAllPaymentsWithStatus();
        $date = getDateTime();

        require ABSPATH . 'resources/customer/creditCustomerPrintPDF.php';
    }

    public function customerEditInvoice($invoice_id)
    {
        $payment = $this->paymentService->getByInvoiceId($invoice_id);
        $invoices_details = $this->invoiceService->getAllInvoicesDetailsByInvoiceId($payment->getInvoiceId());

        require ABSPATH . 'resources/customer/editCustomerInvoice.php';
    }

    public function customerUpdateInvoice($invoice_id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        if ($_POST['new_paid_amount'] < $_POST['paid_amount']) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Sorry you paid maximum value'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $payment = $this->paymentService->getByInvoiceId($invoice_id);
            $payment_details = $this->paymentService->getPaymentDetailsByInvoiceId($invoice_id);
            $payment->setPaidStatus($_POST['paid_status']);

            if ($_POST['paid_status'] === 'full_paid') {
                $payment->setPaidAmount($payment->getPaidAmount() + $_POST['new_paid_amount']);
                $payment->setDueAmount(0);
                $payment_details->setCurrentPaidAmount($_POST['new_paid_amount']);
            } elseif ($_POST['paid_status'] === 'partial_paid') {
                $payment->setPaidAmount($payment->getPaidAmount() + $_POST['paid_amount']);
                $payment->setDueAmount($payment->getDueAmount() + $_POST['paid_amount']);
                $payment_details->setCurrentPaidAmount($_POST['paid_amount']);
            }

            $this->paymentService->update($payment);
            $payment_details->setInvoiceId($invoice_id);
            $payment_details->setDate(date('Y-m-d', strtotime($_POST['date'])));
            $payment_details->setUpdatedBy($user->getId());
            $this->paymentService->updatePaymentDetails($payment_details);

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'success',
                'message' => 'Invoice Update successfully'
            ];
            header("Location: /credit/customer");
            exit;
        }
    }
}
