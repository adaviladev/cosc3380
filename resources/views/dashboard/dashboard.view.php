<?php getHeader(); ?>

<?php if (!empty($user)) { ?>
    <div class="row">
        <div class="container">
            <h1 class="clearfix">
                Welcome, <?= $user->firstName ?> <?= $user->lastName ?>
                <span class="float-right"><a href="/dashboard/reports" class="button">View Reports</a></span>
                <!-- /.text-right -->
            </h1>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.row -->
<?php } ?>

<?php if (!empty($transactions)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2 clearfix">
                <h3>Recent Transactions</h3>
                <?php getPartial('transactionsList', compact('transactions')); ?>
                <div class="text-right">
                    <a href="/dashboard/transactions">View all transactions</a>
                </div>
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php if (!empty($packages)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2">
                <h3>Local Packages</h3>
                <?php getPartial('packagesGrid', compact('packages')); ?>
                <div class="text-right">
                    <a href="/dashboard/packages">View all packages</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php if (!empty($employees)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2 clearfix">
                <h3>Employees</h3>
                <?php getPartial('employeesList', compact('employees')); ?>
                <div class="text-right">
                    <a href="/dashboard/employees">View all employees</a>
                </div>
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php if (!empty($customers)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2">

                <h3>Customers</h3>
                <?php getPartial('customersList', compact('customers')); ?>
                <div class="text-right">
                    <a href="/dashboard/customers">View all customers</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php getFooter(); ?>