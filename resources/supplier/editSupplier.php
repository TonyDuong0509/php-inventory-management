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
                                    <h4 class="card-title">Edit Supplier Page </h4><br><br>
                                    <a href="/all-suppliers">
                                        <p class="text-end" style="color: grey"><- Back all suppliers</p>
                                    </a>
                                    <form method="POST" action="<?php echo $router->generate('update.supplier'); ?>" id="myForm">
                                        <input type="hidden" name="supplierId" value="<?php echo $supplier->getId(); ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                            <div class="form-group col-sm-10">
                                                <input name="name" class="form-control" value="<?php echo $supplier->getName(); ?>" type="text">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile </label>
                                            <div class="form-group col-sm-10">
                                                <input name="mobile_no" value="<?php echo $supplier->getMobileNo(); ?>" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email </label>
                                            <div class="form-group col-sm-10">
                                                <input disabled name="email" value="<?php echo $supplier->getEmail(); ?>" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Address </label>
                                            <div class="form-group col-sm-10">
                                                <input name="address" value="<?php echo $supplier->getAddress(); ?>" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
                    name: "Please provide your name",
                    mobile_no: 'Please provide your mobile no',
                    address: 'Please provide your address'
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