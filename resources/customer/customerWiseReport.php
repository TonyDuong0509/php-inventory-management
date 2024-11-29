<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Customer Wise Report</title>
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
                                <h4 class="mb-sm-0"> Customer Wise Report </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <strong> Customer Wise Credit Report </strong>
                                            <input type="radio" name="customer_wise_report" value="customer_wise_credit" class="search_value"> &nbsp;&nbsp;
                                            <strong> Customer Wise Paid Report </strong>
                                            <input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value">
                                        </div>
                                    </div> <!-- // end row  -->
                                    <!--  /// Customer Credit Wise  -->
                                    <div class="show_credit" style="display:none">
                                        <form method="GET" action="/customer/wise/credit/report" id="myForm" target="_blank">
                                            <div class="row">
                                                <div class="col-sm-8 form-group">
                                                    <label>Customer Name </label>
                                                    <select name="customer_id" class="form-select select2">
                                                        <option value="">Select Customer</option>
                                                        <?php foreach ($customers as $customer): ?>
                                                            <option value="<?php echo $customer->getId(); ?>">
                                                                <?php echo $customer->getName(); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" style="padding-top: 28px;">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--  /// End Customer Credit Wise  -->
                                    <!--  /// show_paid  -->
                                    <div class="show_paid" style="display:none">
                                        <form method="GET" action="/customer/wise/paid/report" id="myForm" target="_blank">
                                            <div class="row">
                                                <div class="col-sm-8 form-group">
                                                    <label>Customer Name </label>
                                                    <select name="customer_id" class="form-select select2">
                                                        <option value="">Select Customer</option>
                                                        <?php foreach ($customers as $customer): ?>
                                                            <option value="<?php echo $customer->getId(); ?>">
                                                                <?php echo $customer->getName(); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" style="padding-top: 28px;">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--  /// End show_paid  -->
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
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'customer_wise_credit') {
                $('.show_credit').show();
            } else {
                $('.show_credit').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'customer_wise_paid') {
                $('.show_paid').show();
            } else {
                $('.show_paid').hide();
            }
        });
    </script>

</body>

</html>