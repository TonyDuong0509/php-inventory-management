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
                                <h4 class="mb-sm-0">Paid Customer All</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/paid/customer/print/pdf" target="_blank" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Print Paid Customer </i></a> <br> <br>
                                    <h4 class="card-title">Paid All Data </h4>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Customer Name</th>
                                                <th>Invoice No </th>
                                                <th>Date</th>
                                                <th>Due Amount</th>
                                                <th>Action</th>

                                        </thead>
                                        <tbody>
                                            <?php foreach ($payments as $key => $payment): ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $payment->getCustomer()->getName(); ?></td>
                                                    <td><?php echo $payment->getInvoice()->getInvoiceNo(); ?></td>
                                                    <td><?php echo $payment->getInvoice()->getDate(); ?></td>
                                                    <td><?php echo $payment->getDueAmount(); ?></td>
                                                    <td>
                                                        <a href="<?php echo $router->generate('customer.invoice.details', ['invoice_id' => $payment->getInvoiceId()]); ?>" class="btn btn-info sm" title="Customer Details" target="_blank"> <i class="fa fa-eye"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

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