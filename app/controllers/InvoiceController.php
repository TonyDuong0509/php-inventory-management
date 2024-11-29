<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\InvoiceService;
use App\Services\PaymentService;
use App\Services\ProductService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class InvoiceController
{
    private $invoiceService;
    private $categoryService;
    private $customerService;
    private $userService;
    private $paymentService;
    private $productService;

    public function __construct(
        InvoiceService $invoiceService,
        CategoryService $categoryService,
        CustomerService $customerService,
        UserService $userService,
        PaymentService $paymentService,
        ProductService $productService,
    ) {
        $this->invoiceService = $invoiceService;
        $this->categoryService = $categoryService;
        $this->customerService = $customerService;
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->productService = $productService;
    }

    public function invoicesAll()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $invoices = $this->invoiceService->getAllInvoices();

        require ABSPATH . 'resources/invoice/allInvoices.php';
    }

    public function invoiceAdd()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $categories = $this->categoryService->getAllCategories();
        $invoice_data = $this->invoiceService->getInvoiceNo('*', null, 'id DESC LIMIT 1');
        if ($invoice_data == null) {
            $fistReg = '0';
            $invoice_no = $fistReg + 1;
        } else {
            $invoice_no = count($this->invoiceService->countAllInvoices()) + 1;
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

                $customer_id = $_POST['customer_id'];

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
                $discount_amount = isset($_POST['discount_amount']) ? $_POST['discount_amount'] : 0;
                if (!is_numeric($discount_amount)) {
                    $discount_amount = 0;
                }

                $paramsPayment = [
                    'paid_status' => $_POST['paid_status'],
                    'paid_amount' => $_POST['paid_amount'],
                    'discount_amount' => $discount_amount,
                    'estimated_amount' => $_POST['estimated_amount'],
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $paramsPaymentDetails = [
                    'date' => $_POST['date'],
                    'updated_by' => $user->getId()
                ];

                $invoice = $this->invoiceService->store($paramsInvoice);

                if (!$invoice) {
                    $_SESSION['toastrNotify'] = [
                        'alert-type' => 'error',
                        'message' => 'Create invoice failed'
                    ];
                    header("Location: /add-invoice");
                    exit;
                }

                $totalItems = count($_POST['category_id']);
                $paramsDetails = [];

                for ($i = 0; $i < $totalItems; $i++) {
                    $paramsDetails[] = [
                        'date' => $_POST['date'],
                        'category_id' => trim($_POST['category_id'][$i]),
                        'product_id' => trim($_POST['product_id'][$i]),
                        'selling_qty' => $_POST['selling_qty'][$i],
                        'unit_price' => $_POST['unit_price'][$i],
                        'selling_price' => $_POST['selling_price'][$i],
                        'status' => '0',
                        'created_at' => getDateTime(),
                        'updated_at' => getDateTime(),
                    ];
                }

                foreach ($paramsDetails as $detail) {
                    $this->invoiceService->storeInvoiceDetails($detail, $invoice);
                }

                $customer = $this->customerService->store($paramsCustomer, $customer_id);
                $this->paymentService->storePayment($invoice, $customer, $paramsPayment, $paramsPaymentDetails);

                $_SESSION['toastrNotify'] = [
                    'alert-type' => 'success',
                    'message' => 'Create invoice successfully'
                ];
                header("Location: /invoice/pending-list");
                exit;
            }
        }
    }

    public function invoicePendingList()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $pendingInvoices = $this->invoiceService->getAllApprovalInvoices();

        require ABSPATH . 'resources/invoice/pendingListInvoice.php';
    }

    public function invoiceDelete($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $invoice = $this->invoiceService->getById($id);
        if (!$invoice) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Invoice is not exist, please try again'
            ];
            header("Location: /invoice/pending-list");
            exit;
        }

        $result = $this->invoiceService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Delete invoice failed'
            ];
            header("Location: /invoice/pending-list");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted invoice successfully'
        ];
        header("Location: /invoice/pending-list");
        exit;
    }

    public function invoiceApprove($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $invoice = $this->invoiceService->getById($id);
        if (!$invoice) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Invoice is not exist, please try again'
            ];
            header("Location: /invoice/pending-list");
            exit;
        }

        $invoicesDetails = $this->invoiceService->getAllInvoicesDetailsByInvoiceId($id);

        require ABSPATH . 'resources/invoice/approveInvoice.php';
    }

    public function approvalStore($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        foreach ($_POST['selling_qty'] as $key => $val) {
            $invoice_details = $this->invoiceService->getInvoiceDetailsById($key);
            $product = $this->productService->getById($invoice_details->getProductId());
            if ($product->getQuantity() < $_POST['selling_qty'][$key]) {
                $_SESSION['toastrNotify'] = [
                    'alert-type' => 'error',
                    'message' => 'Sorry you approve maximum value'
                ];
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        };

        $invoice = $this->invoiceService->getById($id);
        $invoice->setUpdatedBy($user->getId());
        $invoice->setUpdatedAt(getDateTime());
        $invoice->setStatus('1');

        foreach ($_POST['selling_qty'] as $key => $val) {
            $invoice_details = $this->invoiceService->getInvoiceDetailsById($key);
            $invoice_details->setStatus('1');
            $this->invoiceService->updateStatusInvoiceDetails($invoice_details);
            $product = $this->productService->getById($invoice_details->getProductId());
            $product->setQuantity(((float)$product->getQuantity()) - (float)$_POST['selling_qty'][$key]);
            $this->productService->update($product);
        };

        $this->invoiceService->update($invoice);

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Invoice approve successfully'
        ];
        header("Location: /invoice/pending-list");
        exit;
    }

    public function invoicePrintList()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $invoices = $this->invoiceService->getAllInvoices();

        require ABSPATH . 'resources/invoice/printInvoiceList.php';
    }

    public function invoicePrint($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $invoice = $this->invoiceService->getById($id);
        if (!$invoice) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Invoice is not exist, please try again'
            ];
            header("Location: /print/invoice-list");
            exit;
        }

        $invoicesDetails = $this->invoiceService->getAllInvoicesDetailsByInvoiceId($id);

        require ABSPATH . 'resources/invoice/pdfInvoice.php';
    }

    public function downloadFile()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $random = bin2hex(random_bytes(4));
        $file = "/public/downloads/$random.pdf";
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        readfile($file);
        exit;
    }

    public function invoiceDailyReport()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        require ABSPATH . 'resources/invoice/dailyReportInvoice.php';
    }

    public function invoiceDailyPDF()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $sdate = date('Y-m-d', strtotime($_GET['start_date']));
        $edate = date('Y-m-d', strtotime($_GET['end_date']));
        $invoices = $this->invoiceService->getDailyReport($sdate, $edate);


        $start_date = date('Y-m-d', strtotime($_GET['start_date']));
        $end_date = date('Y-m-d', strtotime($_GET['end_date']));

        require ABSPATH . 'resources/invoice/dailyPDFInvoice.php';
    }
}
