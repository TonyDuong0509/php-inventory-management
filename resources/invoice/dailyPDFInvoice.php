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
                                <h4 class="mb-sm-0">Daily Invoice Report</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                                        <li class="breadcrumb-item active"><a href="/invoice/daily-report">Daily Invoice Report</a></li>
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
                                                    <h3 class="font-size-16"><strong>Daily Invoice Report
                                                            <span class="btn btn-info"> <?php echo $start_date; ?> </span> -
                                                            <span class="btn btn-success"> <?php echo $end_date; ?> </span>
                                                        </strong></h3>
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
                                                        <?php if (empty($invoices)): ?>
                                                            <h3 style="color: red; text-align: center;">No data available</h3>
                                                        <?php else: ?>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>No. </strong></td>
                                                                        <td class="text-center"><strong>Customer Name </strong></td>
                                                                        <td class="text-center"><strong>Invoice No </strong>
                                                                        </td>
                                                                        <td class="text-center"><strong>Date</strong>
                                                                        </td>
                                                                        <td class="text-center"><strong>Description</strong>
                                                                        </td>
                                                                        <td class="text-center"><strong>Amount </strong>
                                                                        </td>


                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $total_sum = '0'; ?>
                                                                    <?php foreach ($invoices as $key => $invoice): ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $key + 1; ?></td>
                                                                            <td class="text-center"><?php echo $invoice->getPayment()->getCustomer()->getName(); ?></td>
                                                                            <td class="text-center">#<?php echo $invoice->getInvoiceNo(); ?></td>
                                                                            <td class="text-center"><?php echo $invoice->getDate(); ?></td>
                                                                            <td class="text-center"><?php echo $invoice->getDescription(); ?></td>
                                                                            <td class="text-center">$<?php echo $invoice->getPayment()->getTotalAmount(); ?></td>
                                                                        </tr>
                                                                        <?php $total_sum += $invoice->getPayment()->getTotalAmount(); ?>
                                                                    <?php endforeach; ?>

                                                                    <tr>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line"></td>
                                                                        <td class="no-line text-center">
                                                                            <strong>Grand Amount</strong>
                                                                        </td>
                                                                        <td class="no-line text-end">
                                                                            <h4 class="m-0">$<?php echo $total_sum; ?></h4>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if (empty($invoices)): ?>

                                                    <?php else: ?>
                                                        <div class="d-print-none">
                                                            <div class="float-end">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                <a href="/download-file" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    }
                },
                messages: {
                    start_date: "Please select start date",
                    end_date: "Please select end date",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

</body>

</html>