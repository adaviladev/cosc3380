<?php getHeader(); ?>

<?php if( ! empty( $user ) ) { ?>
    <div class="row">
        <div class="container">
            <h1>Welcome, Prost Master</h1>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.row -->
<?php } ?>
<div class="row">
    <div class="container">
        <?php if( ! empty( $packages ) ) { ?>
            <div class="group-wrapper card-2">
                <h3>Local Packages</h3>
                <?php getPartial( "packagesGrid" , compact( 'packages' ) ); ?>
                <div class="text-right">
                    <a href="/admin/post-offices/<?= $postOfficeId; ?>/packages">View all packages</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="container">
        <?php if( ! empty( $employees ) ) { ?>
            <div class="group-wrapper card-2 clearfix">
                <h3>Employees</h3>
                <?php getPartial( 'employeesList' , compact( 'employees' ) ); ?>
                <div class="text-right">
                    <a href="/admin/post-offices/<?= $postOfficeId; ?>/employees">View all employees</a>
                </div>
            </div>
            <!-- /.group-wrapper -->
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="container">
        <?php if( ! empty( $customers ) ) { ?>
            <div class="group-wrapper card-2">

                <h3>Customers</h3>
                <?php getPartial( 'customersList' , compact( 'customers' ) ); ?>
                <div class="text-right">
                    <a href="/admin/post-offices/<?= $postOfficeId; ?>/customers">View all customers</a>
                </div>
                <!-- /.text-right -->
            </div>
            <!-- /.group-wrapper -->
        <?php } ?>
    </div>
</div>

<?php getFooter(); ?>
