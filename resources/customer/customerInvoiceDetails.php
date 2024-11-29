<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Customers Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <?php require ABSPATH . 'resources/layout/link.php'; ?>
</head>

<body data-topbar="dark">
    <div id="layout-wrapper">

        <?php require ABSPATH . 'resources/layout/header.php'; ?>

        <?php require ABSPATH . 'resources/layout/sidebar.php'; ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"> Customer Payment Report </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                        <li class="breadcrumb-item active">Customer Payment Report</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="invoice-title">
                                                <h4 class="float-end font-size-16"><strong>Invoice No #<?php echo $payment->getInvoice()->getInvoiceNo(); ?></strong></h4>
                                                <h3>
                                                    <img src="<?php ABSPATH ?>/public/images/logo-sm.png" alt="logo" height="24" /> Easy Shopping Mall
                                                </h3>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="col-6 mt-4">
                                                    <address>
                                                        <strong>Easy Shopping Mall:</strong><br>
                                                        Purana Palton Dhaka<br>
                                                        support@easylearningbd.com
                                                    </address>
                                                </div>
                                                <div class="col-6 mt-4 text-end">
                                                    <address>
                                                        <strong>Invoice Date:</strong><br>
                                                        <?php echo $payment->getInvoice()->getDate(); ?><br><br>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <div class="p-2">
                                                    <h3 class="font-size-16"><strong>Customer Invoice</strong></h3>
                                                </div>
                                                <div class="">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <td><strong>Customer Name </strong></td>
                                                                    <td class="text-center"><strong>Customer Mobile</strong></td>
                                                                    <td class="text-center"><strong>Address</strong>
                                                                    </td>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $payment->getCustomer()->getName(); ?></td>
                                                                    <td class="text-center"><?php echo $payment->getCustomer()->getMobileNo(); ?></td>
                                                                    <td class="text-center"><?php echo $payment->getCustomer()->getEmail(); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <div class="p-2">

                                                </div>
                                                <div class="">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <td><strong>No. </strong></td>
                                                                    <td class="text-center"><strong>Category</strong></td>
                                                                    <td class="text-center"><strong>Product Name</strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Current Stock</strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Quantity</strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Unit Price </strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Total Price</strong>
                                                                    </td>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $total_sum = '0'; ?>
                                                                <?php foreach ($invoices_details as $key => $invoice_details): ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $key + 1; ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getCategory()->getName(); ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getProduct()->getName(); ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getProduct()->getQuantity(); ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getSellingQty(); ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getUnitPrice(); ?></td>
                                                                        <td class="text-center"><?php echo $invoice_details->getSellingPrice(); ?></td>
                                                                    </tr>
                                                                    <?php $total_sum += $invoice_details->getSellingPrice(); ?>
                                                                <?php endforeach; ?>

                                                                <tr>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line"></td>
                                                                    <td class="thick-line text-center">
                                                                        <strong>Subtotal</strong>
                                                                    </td>
                                                                    <td class="thick-line text-end">$<?php echo $total_sum ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-center">
                                                                        <strong>Discount Amount</strong>
                                                                    </td>
                                                                    <td class="no-line text-end">$<?php echo $payment->getDiscountAmount(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-center">
                                                                        <strong>Paid Amount</strong>
                                                                    </td>
                                                                    <td class="no-line text-end">$<?php echo $payment->getPaidAmount(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-center">
                                                                        <strong>Due Amount</strong>
                                                                        <input type="hidden" name="new_paid_amount" value="<?php echo $payment->getDueAmount(); ?>">
                                                                    </td>
                                                                    <td class="no-line text-end">$<?php echo $payment->getDueAmount(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-center">
                                                                        <strong>Grand Amount</strong>
                                                                    </td>
                                                                    <td class="no-line text-end">
                                                                        <h4 class="m-0">$<?php echo $payment->getTotalAmount(); ?></h4>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="7" style="text-align: center;font-weight: bold;">Paid Summary</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" style="text-align: center;font-weight: bold;">Date </td>
                                                                    <td colspan="3" style="text-align: center;font-weight: bold;">Amount</td>
                                                                </tr>

                                                                <?php foreach ($payment_details as $details): ?>
                                                                    <tr>
                                                                        <td colspan="4" style="text-align: center;font-weight: bold;"><?php echo $details->getDate(); ?></td>
                                                                        <td colspan="3" style="text-align: center;font-weight: bold;"><?php echo $details->getCurrentPaidAmount(); ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="d-print-none">
                                                        <div class="float-end">
                                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                            <a href="/download-file" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- container-fluid -->
            </div>

            <?php require ABSPATH . 'resources/layout/footer.php'; ?>

        </div>
        <!-- end main content-->

    </div>

    <!-- JAVASCRIPT -->
    <?php require ABSPATH . 'resources/layout/script.php'; ?>
</body>

</html>