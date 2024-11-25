<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Add Purchase Page</title>
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
                                    <h4 class="card-title">Add Purchase </h4><br><br>
                                    <div style="text-align: end;">
                                        <a href="/all-purchases">
                                            <p style="color: gray;"><- Back to purchases</p>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4 form-group">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Date</label>
                                                <input class="form-control example-date-input" name="date" type="datetime-local" id="date">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 form-group">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Purchase No</label>
                                                <input class="form-control example-date-input" name="purchase_no" type="text" id="purchase_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 form-group">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Supplier Name </label>
                                                <select id="supplier_id" name="supplier_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="">Select supplier</option>
                                                    <?php if (!empty($suppliers)): ?>
                                                        <?php foreach ($suppliers as $supplier): ?>
                                                            <option value="<?php echo $supplier->getId(); ?>">
                                                                <?php echo $supplier->getName(); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 form-group">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Category Name </label>
                                                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="">Select category</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 form-group">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Product Name </label>
                                                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="">Select product</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label" style="margin-top:43px;"> </label>
                                                <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                                            </div>
                                        </div>
                                    </div> <!-- // end row  -->
                                </div> <!-- End card-body -->

                                <div class="card-body">
                                    <form method="POST" action="<?php echo $router->generate('store.purchase'); ?>">
                                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Product Name </th>
                                                    <th>PSC/KG</th>
                                                    <th>Unit Price </th>
                                                    <th>Description</th>
                                                    <th>Total Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="addRow" class="addRow">

                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table><br>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-info" id="storeButton"> Purchase Store</button>
                                        </div>
                                    </form>


                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>

                <?php require ABSPATH . 'resources/layout/footer.php'; ?>
                <!-- JAVASCRIPT -->
                <?php require ABSPATH . 'resources/layout/script.php'; ?>

            </div>
            <!-- end main content-->

        </div>
</body>

</html>

<script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
<input type="hidden" name="date[]" value="{{date}}">
<input type="hidden" name="purchase_no[]" value="{{purchase_no}}">
<input type="hidden" name="supplier_id[]" value="{{supplier_id}}">

<td>
<input type="hidden" name="category_id[]" value="{{category_id}}">
{{ category_name }}
</td>

<td>
<input type="hidden" name="product_id[]" value="{{product_id}}">
{{ product_name }}
</td>

<td>
<input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value=""> 
</td>

<td>
<input type="number" class="form-control unit_price text-right" name="unit_price[]" value=""> 
</td>

<td>
<input type="text" class="form-control" name="description[]"> 
</td>

<td>
<input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly> 
</td>

<td>
<i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
</td>

</tr>

</script>