<?php
	getHeader();
?>

<?php if( ! empty( $transactions ) ) { ?>
    <div class="row">
        <div class="container">
            <div class="grid-wrapper clearfix">
                <?php foreach( $transactions as $transaction ) { ?>
                    <div class="col-dt-4 col-tb-6 col-mb-12 grid-item clearfix">
                        <div class="grid-item-content card-2 clearfix">
                            <a href="/transactions/<?= $transaction->id; ?>">
                                <div class="col-dt-12 col-tb-12 col-mb-12 grid-header secondary-bg text-left">
                                    <h3>Transaction: #<?= $transaction->id; ?></h3>
                                </div>
                                <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                                <div class="col-dt-12 col-tb-12 col-mb-12">
                                    Cost: $<?= $transaction->cost; ?>
                                </div>
                                <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                                <div class="col-dt-12 col-tb-12 col-mb-12">
                                    Customer: <?= $transaction->customer->firstName; ?> <?= $transaction->customer->lastName; ?>
                                </div>
                                <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                                <div class="col-dt-12 col-tb-12 col-mb-12">
                                    Employee: <?= $transaction->employee->firstName; ?> <?= $transaction->employee->lastName; ?>
                                </div>
                                <div class="col-dt-12 col-tb-12 col-mb-12">
                                    Post Office: <?= $transaction->postOffice->name; ?>
                                </div>
                                <div class="col-dt-12 col-tb-12 col-mb-12">
                                    Order #<?= $transaction->package->id; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>


<?php
	getFooter();
?>
