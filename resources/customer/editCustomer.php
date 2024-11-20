<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Supplier Page</title>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Customer Page </h4><br><br>
                                    <a href="/all-customers">
                                        <p class="text-end" style="color: grey"><- Back all customers</p>
                                    </a>
                                    <form method="POST" action="<?php echo $router->generate('update.customer'); ?>" id="myForm" enctype="multipart/form-data">
                                        <input type="hidden" name="customerId" value="<?php echo $customer->getId(); ?>">
                                        <input type="hidden" name="old_image" value="<?php echo $customer->getCustomerImage(); ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name </label>
                                            <div class="form-group col-sm-10">
                                                <input name="name" class="form-control" type="text" value="<?php echo $customer->getName(); ?>">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile </label>
                                            <div class="form-group col-sm-10">
                                                <input name="mobile_no" class="form-control" type="text" value="<?php echo $customer->getMobileNo(); ?>">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email </label>
                                            <div class="form-group col-sm-10">
                                                <input name="email" class="form-control" disabled type="email" value="<?php echo $customer->getEmail(); ?>">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address </label>
                                            <div class="form-group col-sm-10">
                                                <input name="address" class="form-control" type="text" value="<?php echo $customer->getAddress(); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Customer Image</label>
                                            <div class="form-group col-sm-10">
                                                <input type="file" class="form-control" name="customer_image" id="image">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <img src="/<?php echo $customer->getCustomerImage() ?>" id="showImage" class="rounded avatar-lg">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="text-end">
                                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Save">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
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
                    name: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    name: "Please provide customer's name",
                    mobile_no: "Please provide customer's mobile no'",
                    address: "Please provide customer's address'",
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

        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                showImage.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>