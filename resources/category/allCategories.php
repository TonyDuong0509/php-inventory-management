<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>All Categories Page</title>
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
                                <h4 class="mb-sm-0">Categories All</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/add-category" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"></i> Add Category </a> <br> <br>
                                    <h4 class="card-title">Categories All Data </h4>
                                    <?php if (empty($categories)): ?>
                                        <h3 style="color: red; text-align: center;">No data available</h3>

                                    <?php else: ?>
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No.</th>
                                                    <th>Name</th>
                                                    <th>Created By</th>
                                                    <th>Updated By</th>
                                                    <th width="20%">Action</th>
                                            </thead>
                                            <tbody>
                                                <?php $stt = 1; ?>
                                                <?php foreach ($categories as $category): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $stt++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $category->getName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $category->getUserCreated()->getFullName(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $category->getUserUpdated()->getFullName(); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo $router->generate('edit.category', ['id' => $category->getId()]); ?>" class="btn btn-info btn-sm" title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                                            <a href="<?php echo $router->generate('delete.category', ['id' => $category->getId()]); ?>" class="btn btn-danger btn-sm" title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
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
</body>

</html>