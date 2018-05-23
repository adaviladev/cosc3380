<?php getHeader(); ?>

<?php if (!empty($packages)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2">
                <h3>Local Packages</h3>
                <?php getPartial('accountPackagesGrid', compact('packages')); ?>
                <div class="text-right">
                    <a href="/account/packages">View all packages</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php if (!empty($transactions)) { ?>
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2">
                <h3>Order History</h3>
                <?php getPartial('accountTransactionsList', compact('transactions')); ?>
                <div class="text-right">
                    <a href="/account/transactions">View all orders</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        </div>
    </div>
<?php } ?>

<?php getFooter(); ?>