<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Category Page</title>
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
                                    <h4 class="card-title">Edit Category Page</h4><br><br>
                                    <a href="/all-categories" style="color: grey;">
                                        <p style="text-align: end;"><- Back to units</p>
                                    </a>
                                    <form method="POST" action="<?php echo $router->generate('update.category'); ?>" id="myForm">
                                        <input type="hidden" name="categoryId" value="<?php echo $category->getId(); ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Category Name </label>
                                            <div class="form-group col-sm-10">
                                                <input name="name" class="form-control" type="text" value="<?php echo $category->getName(); ?>">
                                            </div>
                                        </div>
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
                    }
                },
                messages: {
                    name: "Please provide category's name",
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