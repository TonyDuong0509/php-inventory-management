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
                                <h4 class="mb-sm-0">Supplier and Product Wise Report </h4>

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
                                            <strong> Supplier Wise Report </strong>
                                            <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;
                                            <strong> Product Wise Report </strong>
                                            <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                                        </div>
                                    </div> <!-- // end row  -->
                                    <div class="show_supplier" style="display: none;">
                                        <form method="GET" action="/supplier/wise-pdf" id="myForm" target="_blank">
                                            <div class="row">
                                                <div class="col-sm-8 form-group">
                                                    <label>Supplier Name </label>
                                                    <select name="supplier_id" class="form-select select2">
                                                        <option value="">Select Supplier</option>
                                                        <?php foreach ($suppliers as $supplier): ?>
                                                            <option value="<?php echo $supplier->getId(); ?>">
                                                                <?php echo $supplier->getName(); ?>
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

                                    <div class="show_product" style="display:none; ">
                                        <form method="GET" action="/product/wise-pdf" id="myForm" target="_blank">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Category Name </label>
                                                        <select name="category_id" id="category_id" class="form-select select2">
                                                            <option value="">Select Category</option>
                                                            <?php foreach ($categories as $category): ?>
                                                                <option value="<?php echo $category->getId(); ?>">
                                                                    <?php echo $category->getName(); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Product Name </label>
                                                        <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4" style="padding-top: 28px;">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>
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
            if (search_value == 'supplier_wise') {
                $('.show_supplier').show();
            } else {
                $('.show_supplier').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '.search_value', function() {
            var search_value = $(this).val();
            if (search_value == 'product_wise') {
                $('.show_product').show();
            } else {
                $('.show_product').hide();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },

                },
                messages: {
                    supplier_id: {
                        required: 'Please Select Supplier ',
                    },

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