<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Inventory - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php ABSPATH ?>/public/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="<?php ABSPATH ?>/public/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php ABSPATH ?>/public/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php ABSPATH ?>/public/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <?php global $router; ?>
</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="javascript:void(0)" class="auth-logo">
                                <img src="<?php ABSPATH ?>/public/images/logo-dark.png" height="30" class="logo-dark mx-auto" alt="">
                                <img src="<?php ABSPATH ?>/public/images/logo-light.png" height="30" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>
                    <h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>
                    <div class="p-3">
                        <form id="myForm" class="form-horizontal mt-3" method="POST" action="<?php echo $router->generate('login'); ?>">
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['formData']['email'] ?? ''; ?>">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="form-label ms-1" for="customCheck1">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group mb-0 row mt-2">
                                <div class="col-sm-7 mt-3">
                                    <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                                <div class="col-sm-5 mt-3">
                                    <a href="/register-form" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end -->
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->

    <!-- JAVASCRIPT -->
    <script src="<?php ABSPATH ?>/public/libs/jquery/jquery.min.js"></script>
    <script src="<?php ABSPATH ?>/public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php ABSPATH ?>/public/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php ABSPATH ?>/public/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php ABSPATH ?>/public/libs/node-waves/waves.min.js"></script>
    <script src="<?php ABSPATH ?>/public/js/app.js"></script>
    <script src="<?php ABSPATH ?>/public/js/validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php include ABSPATH . 'resources/layout/libs.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: 'Please enter your email',
                    password: 'Please enter your password'
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