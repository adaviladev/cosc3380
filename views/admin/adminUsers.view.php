<?php
getHeader();
/*
To add:
-Fix individual costumer views

*/
$titles = array('Name', 'Number Of Packages', 'Total Spent', 'Average Spent');
?>
<div class="row">
    <div class="container">
        <h1>All Users</h1>
    </div>
</div>

<!--<div class="row">
    <div class="container">
        <div class="package-wrapper">

        </div>
    </div>
</div> -->
<div class="row">
    <div class="container">
        <?php if( ! empty( $users ) ) { ?>
            <div class="package-wrapper">
                <div class="clearfix primary-bg">
                    <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                        <h4>Name</h4>
                    </div>
                    <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                        <h4>Number Of Packages</h4>
                    </div>
                    <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                        <h4>Total Spent</h4>
                    </div>
                    <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                        <h4>Average Spent</h4>
                    </div>
                </div>
                <?php foreach( $users as $user ) { ?>
                    <a href="/users/<?= $user->id ?>" class="package-list-item clearfix">
                        <div class="clearfix">
                            <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                                <?= $user->firstName?><?= $user->lastName?>
                            </div>
                            <!-- /.col-dt-2 col-tb-4 col-mb-6 -->
                            <div class="col-dt-2 col-tb-4 col-mb-6 text-center" >
                                <?= $user->packageCount?>
                            </div>
                            <!-- /.col-dt-2 col-tb-4 col-mb-6 -->
                            <div class="col-dt-2 col-tb-4 col-mb-6 text-center" >
                                <?= $user->transactionTotal ?>
                            </div>
                            <!-- /.col-dt-2 col-tb-4 col-mb-6 -->
                            <div class="col-dt-2 col-tb-4 col-mb-6 text-center">
                                <?= $user->averageSpent ?>
                            </div>
                            <!-- /.col-dt-2 col-tb-4 col-mb-6 -->
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>


<?php
getFooter();
?>
