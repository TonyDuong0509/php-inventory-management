<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Inventory - Register</title>
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
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

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
                    <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>
                    <div class="p-3">
                        <form class="form-horizontal mt-3" method="POST" action="<?php echo $router->generate('register'); ?>" id="myForm">
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="text" name="fullName" placeholder="Full name" value="<?php echo $_SESSION['formData']['fullName'] ?? ''; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['formData']['email'] ?? ''; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="number" name="phone" placeholder="Phone number" value="<?php echo $_SESSION['formData']['phone'] ?? ''; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
                                    <span id='message'></span>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-12 form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="form-label ms-1 fw-normal" for="customCheck1">I accept Terms and Conditions</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>
                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3 text-center">
                                    <a href="/login-form" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    fullName: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    confirmPassword: {
                        required: true,
                    },
                },
                messages: {
                    fullName: "Please provide your full name",
                    email: 'Please provide your email',
                    phone: 'Please provide your phone',
                    password: 'Please provide your password',
                    confirmPassword: 'Please provide your confirm password'
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

        $('#password, #confirmPassword').on('keyup', function() {
            if ($('#password').val() == $('#confirmPassword').val()) {
                $('#message').html('Password is matched').css('color', 'green');
            } else
                $('#message').html("Password isn't matching").css('color', 'red');
        });
    </script>

    <?php include ABSPATH . 'resources/layout/libs.php'; ?>

</body>

</html>