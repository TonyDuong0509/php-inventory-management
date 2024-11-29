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
                                <h4 class="mb-sm-0">Customer Invoice</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                        <li class="breadcrumb-item active">Customer Invoice</li>
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
                                    <a href="/credit/customer" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-list"> Back </i></a> <br> <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <div class="p-2">
                                                    <h3 class="font-size-16"><strong>Customer Invoice ( Invoice No: #<?php echo $payment->getInvoice()->getInvoiceNo(); ?> ) </strong></h3>
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
                                            <form method="POST" action="<?php echo $router->generate('customer.update.invoice', ['invoice_id' => $payment->getInvoice()->getId()]); ?>">
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
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label> Paid Status </label>
                                                            <select name="paid_status" id="paid_status" class="form-select">
                                                                <option value="">Select Status </option>
                                                                <option value="full_paid">Full Paid </option>
                                                                <option value="partial_paid">Partial Paid </option>
                                                            </select>
                                                            <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <div class="md-3">
                                                                <label for="example-text-input" class="form-label">Date</label>
                                                                <input class="form-control example-date-input" placeholder="YYYY-MM-DD" name="date" type="date" id="date">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <div class="md-3" style="padding-top: 30px;">
                                                                <button type="submit" class="btn btn-info">Invoice Update</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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

    <script type="text/javascript">
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });
    </script>

</body>

</html>