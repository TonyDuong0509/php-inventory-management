<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Print Invoice List</title>
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
                                <h4 class="mb-sm-0">Print Invoice All</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/add-invoice" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Invoice </i></a> <br> <br>
                                    <h4 class="card-title">Invoice All Data </h4>

                                    <?php if (empty($invoices)): ?>
                                        <h2 style="color: red; text-align: center;">No data available</h2>
                                    <?php else: ?>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Customer Name</th>
                                                    <th>Invoice No </th>
                                                    <th>Date </th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($invoices as $key => $invoice): ?>
                                                    <tr>
                                                        <td><?php echo $key + 1; ?></td>
                                                        <td><?php echo $invoice->getPayment()->getCustomer()->getName(); ?></td>
                                                        <td>#<?php echo $invoice->getInvoiceNo(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice->getDate(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice->getDescription(); ?>
                                                        </td>
                                                        <td>$<?php echo $invoice->getPayment()->getTotalAmount(); ?></td>
                                                        <td>
                                                            <a href="<?php echo $router->generate('print.invoice', ['id' => $invoice->getId()]); ?>" class="btn btn-danger sm" title="Print Invoice"> <i class="fa fa-print"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
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