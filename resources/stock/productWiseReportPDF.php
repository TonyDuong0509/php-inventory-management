<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Suppliers Page</title>
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
                                <h4 class="mb-sm-0">Product Wise Stock Report</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                        <li class="breadcrumb-item active"><a href="/supplier/product/wise-report">Product Wise Stock Report</a></li>
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

                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <div class="p-2">
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
                                                                    <td class="text-center"><strong>Supplier Name </strong></td>
                                                                    <td class="text-center"><strong>Unit </strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Category</strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Product Name</strong>
                                                                    </td>
                                                                    <td class="text-center"><strong>Stock </strong>
                                                                    </td>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($products as $key => $product): ?>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <?php echo $key + 1; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $product->getSupplier()->getName(); ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $product->getUnit()->getName(); ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $product->getCategory()->getName(); ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $product->getName(); ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $product->getQuantity(); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <i>Printing Time: <?php echo $date; ?></i>
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