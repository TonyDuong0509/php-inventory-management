<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Add Product Page</title>
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
                                    <h4 class="card-title">Add Product Page</h4><br><br>
                                    <a href="/all-products" style="color: grey;">
                                        <p style="text-align: end;"><- Back to products</p>
                                    </a>
                                    <form method="POST" action="<?php echo $router->generate('store.product'); ?>" id="myForm">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Product Name </label>
                                            <div class="form-group col-sm-10">
                                                <input name="name" class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                            <div class="form-group col-sm-10">
                                                <select name="supplier_id" class="form-select" aria-label="Default select example">
                                                    <option selected="">Select supplier</option>
                                                    <?php foreach ($suppliers as $supplier): ?>
                                                        <option value="<?php echo $supplier->getId(); ?>">
                                                            <?php echo $supplier->getName(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                                            <div class="form-group col-sm-10">
                                                <select name="unit_id" class="form-select" aria-label="Default select example">
                                                    <option selected="">Select unit</option>
                                                    <?php foreach ($units as $unit): ?>
                                                        <option value="<?php echo $unit->getId(); ?>">
                                                            <?php echo $unit->getName(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                                            <div class="form-group col-sm-10">
                                                <select name="category_id" class="form-select" aria-label="Default select example">
                                                    <option selected="">Select category</option>
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category->getId(); ?>">
                                                            <?php echo $category->getName(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
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
                    supplier_id: {
                        required: true,
                    },
                    unit_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    name: "Please provide product's name",
                    supplier_id: "Please provide supplier's name",
                    unit_id: "Please provide unit's name",
                    category_id: "Please provide category's name",
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