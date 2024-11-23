<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Purchases Page</title>
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
                                <h4 class="mb-sm-0">Purchases All</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/add-purchase" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Purchase </a> <br> <br>
                                    <h4 class="card-title">Purchases All Data </h4>
                                    <?php if (empty($purchases)): ?>
                                        <h3 style="color: red; text-align: center;">No data available</h3>

                                    <?php else: ?>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Purchase No</th>
                                                    <th>Date</th>
                                                    <th>Supplier</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Product</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php $stt = 1; ?>
                                                <?php foreach ($purchases as $purchase): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $stt++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getPurchaseNo(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getDate(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getSupplier()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getCategory()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getBuyingQty(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $purchase->getProduct()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($purchase->getStatus() === '0'): ?>
                                                                <span class="btn btn-warning">Pending</span>
                                                            <?php else: ?>
                                                                <span class="btn btn-success">Approved</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($purchase->getStatus() === '0'): ?>
                                                                <a href="<?php echo $router->generate('delete.purchase', ['id' => $purchase->getId()]); ?>" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>
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