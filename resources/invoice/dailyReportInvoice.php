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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daily Invoice Report </h4><br><br>
                                    <form method="GET" action="/invoice/daily-pdf" target="_blank" id="myForm">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="md-3 form-group">
                                                    <label for="example-text-input" class="form-label">Start Date</label>
                                                    <input class="form-control example-date-input" name="start_date" type="date" id="start_date" placeholder="YY-MM-DD">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="md-3 form-group">
                                                    <label for="example-text-input" class="form-label">End Date</label>
                                                    <input class="form-control example-date-input" name="end_date" type="date" id="end_date" placeholder="YY-MM-DD">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="md-3">
                                                    <label for="example-text-input" class="form-label" style="margin-top:43px;"> </label>
                                                    <button type="submit" class="btn btn-info">Search</button>
                                                </div>
                                            </div>
                                        </div> <!-- // end row  -->
                                    </form>
                                </div> <!-- End card-body -->
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