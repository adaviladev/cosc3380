<?php
	getHeader();
?>

<div class="row">
    <div class="container">
        <?php if( ! empty( $postOffice ) ) { ?>
            <div class="package-wrapper">
                <div class="package-item card-2 clearfix">
                    <div class="package-detail-content">
                        <div class="col-dt-12 col-tt-12 col-mb-12 text-left primary-bg">
                            <div class="package-detail-header">
                                <p>
                                    <?= $postOffice->name ?><br/>
                                    Address: <?= $postOffice->address; ?>
                                </p>
                            </div>
                            <!-- /.package-detail-header -->
                        </div>
                        <!-- /.col-dt-12 col-tt-12 col-mb-12 text-left -->
<!--                        <!-- /.col-dt-12 -->-->
<!--                        <div class="col-dt-12 text-left clearfix">-->
<!--                            <div class="package-detail-info clearfix">-->
<!--                                <p>--><?//= $package->status->type; ?><!--</p>-->
<!--                                <div class="col-dt-6 col-mb-12">-->
<!--                                    <p>Origin:</p>-->
<!--                                    --><?//= $package->returnAddress->street; ?><!--,<br/>-->
<!--                                    --><?//= $package->returnAddress->city; ?><!--, --><?//= $package->returnAddress->state; ?><!-- --><?//= $package->returnAddress->zipCode; ?>
<!--                                </div>-->
<!--                                <!-- /.col-dt-12 -->-->
<!--                                <div class="col-dt-6 col-mb-12">-->
<!--                                    <p>Destination:</p>-->
<!--                                    --><?//= $package->destination->street; ?><!--,<br/>-->
<!--                                    --><?//= $package->destination->city; ?><!--, --><?//= $package->destination->state; ?><!-- --><?//= $package->destination->zipCode; ?>
<!--                                </div>-->
<!--                                <!-- /.col-dt-12 -->-->
<!--                                --><?php //if( $package->packageStatus == 1 ) { ?>
<!--                                    <a href="/dashboard/packages/edit/--><?//= $package->id; ?><!--" class="button">Edit</a>-->
<!--                                    <!-- /.button -->-->
<!--                                --><?php //} ?>
<!--                            </div>-->
<!--                            <!-- /.package-detail-info -->-->
<!--                        </div>-->
                        <!-- /.col-dt-12 -->
                    </div>
                    <!-- /.package-content -->
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php
	getFooter();
?>
