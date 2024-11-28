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
                                <h4 class="mb-sm-0">Stock Report All</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/stock/report-pdf" target="_blank" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-print"> Stock Report Print </i></a> <br> <br>
                                    <h4 class="card-title">Stock Report </h4>
                                    <?php if (empty($products)): ?>
                                        <h3 style="color: red; text-align: center;">No data available</h3>
                                    <?php else: ?>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Supplier Name </th>
                                                    <th>Unit</th>
                                                    <th>Category</th>
                                                    <th>Product Name</th>
                                                    <th>Stock </th>

                                            </thead>
                                            <tbody>
                                                <?php foreach ($products as $key => $product): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $key + 1; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product->getSupplier()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product->getUnit()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product->getCategory()->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $product->getQuantity(); ?>
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