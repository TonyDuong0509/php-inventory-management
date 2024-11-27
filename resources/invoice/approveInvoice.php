<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Approve Invoice</title>
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
                                <h4 class="mb-sm-0">Invoice Approve</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 style="color: green;">
                                        Invoice No: #<?php echo $invoice->getInvoiceNo(); ?> - <?php echo $invoice->getDate(); ?>
                                    </h4>
                                    <a href="/invoice/pending-list" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-list"> Pending Invoice List </i></a> <br> <br>

                                    <table class="table table-dark mt-3" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p> Customer Info </p>
                                                </td>
                                                <td>
                                                    <p> Name: <strong><?php echo $invoice->getPayment()->getCustomer()->getName(); ?></strong> </p>
                                                </td>
                                                <td>
                                                    <p> Mobile: <strong><?php echo $invoice->getPayment()->getCustomer()->getMobileNo(); ?></strong> </p>
                                                </td>
                                                <td>
                                                    <p> Email: <strong><?php echo $invoice->getPayment()->getCustomer()->getEmail(); ?></strong> </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3">
                                                    <p> Description : <strong><?php echo $invoice->getDescription() ?></strong> </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <form method="POST" action="<?php echo $router->generate('approval.store', ['id' => $invoice->getId()]); ?>">
                                        <table border="1" class="table table-dark" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Product Name</th>
                                                    <th class="text-center" style="background-color: #8B008B">Current Stock</th>
                                                    <th class=" text-center">Quantity</th>
                                                    <th class="text-center">Unit Price </th>
                                                    <th class="text-center">Total Price</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php $total_sum = '0'; ?>
                                                <?php foreach ($invoicesDetails as $key => $details): ?>
                                                    <tr>
                                                        <input type="hidden" name="category_id[]" value="<?php echo $details->getCategoryId(); ?>">
                                                        <input type="hidden" name="product_id[]" value="<?php echo $details->getProductId(); ?>">
                                                        <input type="hidden" name="selling_qty[<?php echo $details->getId(); ?>]" value="<?php echo $details->getSellingQty(); ?>">

                                                        <td class="text-center">
                                                            <?php echo $key + 1; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getCategory()->getName(); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getProduct()->getName(); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getProduct()->getQuantity(); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getSellingQty(); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getUnitPrice(); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $details->getSellingPrice(); ?>
                                                        </td>
                                                    </tr>
                                                    <?php $total_sum += $details->getSellingPrice(); ?>
                                                <?php endforeach; ?>

                                                <tr>
                                                    <td colspan="6"> Sub Total </td>
                                                    <td>$<?php echo $total_sum; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"> Discount </td>
                                                    <td>$<?php echo $invoice->getPayment()->getDiscountAmount(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"> Paid Amount </td>
                                                    <td>$<?php echo $invoice->getPayment()->getPaidAmount(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"> Due Amount </td>
                                                    <td>$<?php echo $invoice->getPayment()->getDueAmount(); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"> Grand Amount </td>
                                                    <td>$<?php echo $invoice->getPayment()->getTotalAmount(); ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-info">Invoice Approve </button>
                                        </div>
                                    </form>

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