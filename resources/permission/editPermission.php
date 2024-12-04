<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Permission Page</title>
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
                                    <h4 class="card-title">Edit Permission Page</h4><br><br>
                                    <a href="/all-permissions" style="color: grey;">
                                        <p style="text-align: end;"><- Back to permissions</p>
                                    </a>
                                    <form method="POST" action="/update-permission" id="myForm">
                                        <input type="hidden" name="id" value="<?= $permission->getId(); ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Permission Name </label>
                                            <div class="form-group col-sm-10">
                                                <input name="name" class="form-control" type="text" value="<?= $permission->getName(); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Guard Name </label>
                                            <div class="form-group col-sm-10">
                                                <select name="guard_name" class="form-select mb-3" aria-label="Default select example">
                                                    <option selected="" disabled>Open this select menu</option>
                                                    <option <?= $permission->getGuardName() === 'Dashboard' ? 'selected' : ''; ?> value="Dashboard">Dashboard</option>
                                                    <option <?= $permission->getGuardName() === 'Suppliers' ? 'selected' : ''; ?> value="Suppliers">Suppliers</option>
                                                    <option <?= $permission->getGuardName() === 'Customers' ? 'selected' : ''; ?> value="Customers">Customers</option>
                                                    <option <?= $permission->getGuardName() === 'Units' ? 'selected' : ''; ?> value="Units">Units</option>
                                                    <option <?= $permission->getGuardName() === 'Categories' ? 'selected' : ''; ?> value="Categories">Categories</option>
                                                    <option <?= $permission->getGuardName() === 'Products' ? 'selected' : ''; ?> value="Products">Products</option>
                                                    <option <?= $permission->getGuardName() === 'Purchases' ? 'selected' : ''; ?> value="Purchases">Purchases</option>
                                                    <option <?= $permission->getGuardName() === 'Invoice' ? 'selected' : ''; ?> value="Invoice">Invoice</option>
                                                    <option <?= $permission->getGuardName() === 'Stock' ? 'selected' : ''; ?> value="Stock">Stock</option>
                                                    <option <?= $permission->getGuardName() === 'Permissions' ? 'selected' : ''; ?> value="Permissions">Permissions</option>
                                                    <option <?= $permission->getGuardName() === 'Role' ? 'selected' : ''; ?> value="Role">Role</option>
                                                </select>
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
                    name: "Please provide unit's name",
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