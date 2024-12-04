<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Role Permissions Page</title>
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
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Roles Name </th>
                                                    <th>Permission </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($roles)): ?>
                                                    <?php foreach ($roles as $key => $role): ?>
                                                        <tr>
                                                            <td><?php echo $key + 1; ?></td>
                                                            <td><?php echo $role->getName(); ?></td>
                                                            <td>
                                                                <?php if (!empty($role->getPermissionName())): ?>
                                                                    <?php foreach ($role->getPermissionName() as $permission): ?>
                                                                        <span class="badge bg-danger"><?php echo $permission->getName(); ?></span>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?= $router->generate('edit.role.permissions', ['id' => $role->getId()]); ?>" class="btn btn-info px-5">Add & Edit</a>
                                                                <a href="<?= $router->generate('delete.role.permissions', ['id' => $role->getId()]); ?>" class="btn btn-danger px-5" id="delete">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
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
</body>

</html>