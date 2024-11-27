<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Products Page</title>
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
                                <h4 class="mb-sm-0">All Approval Invoices</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/add-invoice" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Invoice </i></a> <br> <br>
                                    <h4 class="card-title">All Approval Invoices Data</h4>
                                    <?php if (empty($pendingInvoices)): ?>
                                        <h2 style="color: red; text-align: center;">No data available</h2>
                                    <?php else: ?>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Customer Name </th>
                                                    <th>Invoice No </th>
                                                    <th>Date </th>
                                                    <th>Description </th>
                                                    <th>Amount </th>
                                                    <th>Status </th>
                                                    <th>Action </th>
                                            </thead>
                                            <tbody>
                                                <?php $stt = 1; ?>
                                                <?php foreach ($pendingInvoices as $invoice): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $stt++; ?>
                                                        </td>
                                                        <td>
                                                            <a style="color: violet;" href="<?php echo $router->generate('edit.customer', ['id' => $invoice->getPayment()->getCustomer()->getId()]); ?>">
                                                                <?php echo $invoice->getPayment()->getCustomer()->getName(); ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            #<?php echo $invoice->getInvoiceNo(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice->getDate(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $invoice->getDescription(); ?>
                                                        </td>
                                                        <td>
                                                            $<?php echo $invoice->getPayment()->getTotalAmount(); ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($invoice->getStatus() === '0'): ?>
                                                                <span class="btn btn-warning">Pending</span>
                                                            <?php else: ?>
                                                                <span class="btn btn-success">Approved</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($invoice->getStatus() === '0'): ?>
                                                                <a href="<?php echo $router->generate('approve.invoice', ['id' => $invoice->getId()]); ?>" class="btn btn-dark sm" title="Approved Data"> <i class="fas fa-check-circle"></i> </a>
                                                                <a href="<?php echo $router->generate('delete.invoice', ['id' => $invoice->getId()]); ?>" class="btn btn-danger sm" title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i></a>
                                                            <?php endif; ?>
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