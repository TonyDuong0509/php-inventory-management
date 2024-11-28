<?php

namespace App\Controllers;

use App\Services\ProductService;
use App\Services\PurchaseService;
use App\Services\SupplierService;
use App\Services\UserService;
use DateTime;
use DateTimeZone;

use function Utils\Functions\getDateTime;

class PurchaseController
{
    private $purchaseService;
    private $supplierService;
    private $userService;
    private $productService;

    public function __construct(
        PurchaseService $purchaseService,
        SupplierService $supplierService,
        UserService $userService,
        ProductService $productService,
    ) {
        $this->purchaseService = $purchaseService;
        $this->supplierService = $supplierService;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function purchasesAll()
    {
        $purchases = $this->purchaseService->getAllPurchases();

        require ABSPATH . 'resources/purchase/allPurchases.php';
    }

    public function purchaseAdd()
    {
        $suppliers = $this->supplierService->getAllSuppliers();

        require ABSPATH . 'resources/purchase/addPurchase.php';
    }

    public function purchaseStore()
    {
        $id = $_SESSION['user']['id'];
        $user = $this->userService->getById($id);

        if (empty($_POST['category_id']) || !isset($_POST['category_id'])) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => "error",
                'message' => 'Sorry you donot select any item'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $count_category = count($_POST['category_id']);
            for ($i = 0; $i < $count_category; $i++) {
                $date = new DateTime($_POST['date'][$i], new DateTimeZone('Asia/Ho_Chi_Minh'));
                $formattedDate = $date->format('Y-m-d H:i:s');

                $params = [
                    'date' => $formattedDate,
                    'purchase_no' => $_POST['purchase_no'][$i],
                    'supplier_id' => $_POST['supplier_id'][$i],
                    'category_id' => $_POST['category_id'][$i],
                    'product_id' => $_POST['product_id'][$i],
                    'buying_qty' => $_POST['buying_qty'][$i],
                    'unit_price' => $_POST['unit_price'][$i],
                    'buying_price' => $_POST['buying_price'][$i],
                    'description' => $_POST['description'][$i],
                    'created_by' => $user->getId(),
                    'updated_by' => $user->getId(),
                    'created_at' => getDateTime(),
                    'updated_at' => getDateTime(),
                ];

                $this->purchaseService->store($params);
            }

            $_SESSION['toastrNotify'] = [
                'alert-type' => "success",
                'message' => 'Purchase save successfully'
            ];
            header("Location: /all-purchases");
            exit;
        }
    }

    public function purchasePending()
    {
        $pendingPurchases = $this->purchaseService->getAllPendingPurchases();

        require ABSPATH . 'resources/purchase/pendingPurchase.php';
    }

    public function purchaseDelete($id)
    {
        $purchase = $this->purchaseService->getById($id);

        if (!$purchase) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Purchase is not exist'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $result = $this->purchaseService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Deleted purchase failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted purchase successfully'
        ];
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function purchaseApprove($id)
    {
        $purchase = $this->purchaseService->getById($id);

        if (!$purchase) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Purchase is not exist'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $product = $this->productService->getById($purchase->getProductId());
        $purchase_qty = (floatval($purchase->getBuyingQty()) + floatval($product->getQuantity()));
        $product->setQuantity($purchase_qty);

        if ($this->productService->update($product)) {
            $this->purchaseService->approveStatus($purchase->getId());

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'success',
                'message' => 'Approved purchase successfully'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function dailyPurchaseReport()
    {
        require ABSPATH . 'resources/purchase/dailyPurchaseReport.php';
    }

    public function dailyPurchaseReportPDF()
    {
        $sdate = date('Y-m-d', strtotime($_GET['start_date']));
        $edate = date('Y-m-d', strtotime($_GET['end_date']));

        $purchases = $this->purchaseService->dailyPurchaseReport($sdate, $edate);

        $start_date = date('Y-m-d', strtotime($_GET['start_date']));
        $end_date = date('Y-m-d', strtotime($_GET['end_date']));

        require ABSPATH . 'resources/purchase/dailyPurchaseReportPDF.php';
    }
}
