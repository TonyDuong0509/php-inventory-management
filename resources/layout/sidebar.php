<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="<?php ABSPATH ?>/public/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1"><?php echo $_SESSION['user']['fullName'] ?? ''; ?></h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo $router->generate('dashboard'); ?>" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Suppliers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo $router->generate('all.suppliers'); ?>">All Suppliers</a></li>
                        <li><a href="<?php echo $router->generate('add.supplier'); ?>">Add Supplier</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-customers">All Customers</a></li>
                        <li><a href="/add-customer">Add Customer</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Units</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-units">All Units</a></li>
                        <li><a href="/add-unit">Add Unit</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-categories">All Categories</a></li>
                        <li><a href="/add-category">Add Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-products">All Products</a></li>
                        <li><a href="/add-product">Add Product</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Purchases</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-purchases">All Purchases</a></li>
                        <li><a href="/pending-purchase">Approval Purchases</a></li>
                        <li><a href="/add-purchase">Add Purchase</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Invoice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/all-invoices">All Invoices</a></li>
                        <li><a href="/invoice/pending-list">Approval Invoices</a></li>
                        <li><a href="/print/invoice-list">Print Invoice List</a></li>
                        <li><a href="/invoice/daily-report">Invoice Daily Report</a></li>
                        <li><a href="/add-invoice">Add Invoice</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>