<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Role Permissions Page</title>
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
                                    <form action="<?= $router->generate('update.role.permissions', ['id' => $role->getId()]); ?>" method="POST" class="row g-3">
                                        <div class="form-group col-md-6">
                                            <label for="input1" class="form-label"> Roles Name</label>
                                            <h4><?php echo $role->getName(); ?></h4>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckMain">
                                            <label class="form-check-label" for="flexCheckMain">Permission All </label>
                                        </div>
                                        <hr>

                                        <?php if (!empty($permissions_groups)): ?>
                                            <?php foreach ($permissions_groups as $group): ?>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <!-- Group Checkbox (for guard_name) -->
                                                            <label class="form-check-label" for="flexCheckDefault-<?php echo htmlspecialchars($group['guard_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                                                <?php echo htmlspecialchars($group['guard_name'], ENT_QUOTES, 'UTF-8'); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <?php if (!empty($permissions_groups_byName[$group['guard_name']])): ?>
                                                            <?php foreach ($permissions_groups_byName[$group['guard_name']] as $permission): ?>
                                                                <div class="form-check">
                                                                    <!-- Permission Checkbox -->
                                                                    <input class="form-check-input" type="checkbox" name="permission[]" value="<?php echo htmlspecialchars($permission->getId(), ENT_QUOTES, 'UTF-8'); ?>"
                                                                        id="checkDefault<?php echo htmlspecialchars($permission->getId(), ENT_QUOTES, 'UTF-8'); ?>"
                                                                        <?php echo $role->hasPermissionTo($permission->getName()) ? 'checked' : ''; ?>>
                                                                    <label class="form-check-label" for="checkDefault<?php echo htmlspecialchars($permission->getId(), ENT_QUOTES, 'UTF-8'); ?>">
                                                                        <?php echo htmlspecialchars($permission->getName(), ENT_QUOTES, 'UTF-8'); ?>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        <br>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>


                                        <div class="col-md-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                            </div>
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

    <script>
        $('#flexCheckMain').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>

</body>

</html>