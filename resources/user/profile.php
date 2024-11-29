<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Add Customer Page</title>
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
                                    <h4 class="card-title">Profile Page</h4><br><br>
                                    <a href="/">
                                        <p class="text-end" style="color: grey"><- Back to dashboard</p>
                                    </a>
                                    <form method="POST" action="/update-profile" id="myForm" enctype="multipart/form-data">
                                        <input type="hidden" name="old_image" value="<?php echo $user->getAvatar() ?? ''; ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Full Name </label>
                                            <div class="form-group col-sm-10">
                                                <input name="fullName" class="form-control" type="text" value="<?php echo $user->getFullName(); ?>">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="form-group col-sm-10">
                                                <input name="phone" class="form-control" type="text" value="<?php echo $user->getPhone(); ?>">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Email </label>
                                            <div class="form-group col-sm-10">
                                                <input name="email" class="form-control" type="email" disabled value="<?php echo $user->getEmail(); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Avatar</label>
                                            <div class="form-group col-sm-10">
                                                <input type="file" class="form-control" name="avatar" id="image">
                                            </div>
                                        </div>
                                        <?php if ($user->getAvatar() === NULL): ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <img src="<?php ABSPATH ?>/public/uploads/no_image.jpg" id="showImage" class="rounded avatar-lg">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <img src="<?php echo $user->getAvatar(); ?>" id="showImage" class="rounded avatar-lg">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <!-- end row -->
                                        <div class="text-end">
                                            <a href="/change/password/page" class="btn btn-warning">Change Password</a>
                                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
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
                    }
                },
                messages: {
                    name: "Please provide customer's name",
                    mobile_no: "Please provide customer's mobile no",
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