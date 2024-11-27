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
                                    <h4 class="card-title">Add Invoice </h4><br><br>
                                    <div style="text-align: end;">
                                        <a href="/all-invoices">
                                            <p style="color: gray;"><- Back to invoices</p>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Invoice No</label>
                                                <input class="form-control example-date-input" name="invoice_no" type="text" id="invoice_no" value="<?php echo $invoice_no; ?>" readonly style="background-color:#ddd">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Date</label>
                                                <input class="form-control example-date-input" name="date" value="<?php echo $date; ?>" type="date" id="date">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Category Name </label>
                                                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="">Open this select menu</option>
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category->getId(); ?>">
                                                            <?php echo $category->getName(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Product Name </label>
                                                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="">Open this select menu</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label">Stock(Pic/Kg)</label>
                                                <input class="form-control example-date-input" name="current_stock_qty" type="text" id="current_stock_qty" readonly style="background-color:#ddd">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="md-3">
                                                <label for="example-text-input" class="form-label" style="margin-top:43px;"> </label>
                                                <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                                            </div>
                                        </div>
                                    </div> <!-- // end row  -->

                                </div> <!-- End card-body -->
                                <!--  ---------------------------------- -->
                                <div class="card-body">
                                    <form method="POST" action="<?php echo $router->generate('store.invoice'); ?>">
                                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th width="7%">Product Name </th>
                                                    <th width="10%">PSC/KG</th>
                                                    <th width="15%">Unit Price </th>
                                                    <th width="7%">Total Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="addRowInvoice" class="addRow">

                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4"> Discount</td>
                                                    <td>
                                                        <input type="number" name="discount_amount" id="discount_amount" class="form-control estimated_amount" placeholder="Discount Amount">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">Grand Total</td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table><br>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label> Paid Status </label>
                                                <select name="paid_status" id="paid_status" class="form-select">
                                                    <option value="">Select Status </option>
                                                    <option value="full_paid">Full Paid </option>
                                                    <option value="full_due">Full Due </option>
                                                    <option value="partial_paid">Partial Paid </option>
                                                </select>
                                                <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label> Customer Name </label>
                                                <select name="customer_id" id="customer_id" class="form-select">
                                                    <option value="">Select Customer </option>
                                                    <?php foreach ($customers as $customer): ?>
                                                        <option value="<?php echo $customer->getId(); ?>">
                                                            <?php echo $customer->getName(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <option value="0"> - Create New Customer - </option>
                                                </select>
                                            </div>
                                        </div> <!-- // end row --> <br>

                                        <!-- Hide Add Customer Form -->
                                        <div class="row new_customer" style="display:none">
                                            <div class="form-group col-md-4">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Write Customer Name">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Write Customer Mobile No">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Write Customer Email">
                                            </div>
                                        </div>
                                        <!-- End Hide Add Customer Form -->
                                        <br>

                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-info" id="storeButton"> Invoice Store</button>
                                        </div>
                                    </form>
                                </div> <!-- End card-body -->
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
                <?php require ABSPATH . 'resources/layout/footer.php'; ?>
                <!-- JAVASCRIPT -->
                <?php require ABSPATH . 'resources/layout/script.php'; ?>
            </div>
        </div>
</body>

</html>

<script id="document-template" type="text/x-handlebars-template">

    <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date" value="{{date}}">
    <input type="hidden" name="invoice_no" value="{{invoice_no}}">

<td>
<input type="hidden" name="category_id[]" value="{{category_id}}">
{{ category_name }}
</td>

<td>
<input type="hidden" name="product_id[]" value="{{product_id}}">
{{ product_name }}
</td>

<td>
<input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]" value=""> 
</td>

<td>
<input type="number" class="form-control unit_price text-right" name="unit_price[]" value=""> 
</td>

<td>
<input type="number" class="form-control selling_price text-right" name="selling_price[]" value="0" readonly> 
</td>

<td>
<i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
</td>

</tr>

</script>

<script type="text/javascript">

</script>