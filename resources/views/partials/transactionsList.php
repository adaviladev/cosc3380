<?php

use App\Core\Auth;

?>
<div class="list-wrapper card-2">
    <?php if (!empty($transactions)) { ?>
        <div class="list-header primary-bg clearfix">
            <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
                <div class="list-item-content">
                    <strong>Transaction Id</strong>
                </div>
            </div>
            <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
                <div class="list-item-content">
                    <strong>Package Id</strong>
                </div>
            </div>
            <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
                <div class="list-item-content">
                    <strong>Customer</strong>
                </div>
            </div>
            <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
                <div class="list-item-content">
                    <strong>Cost</strong>
                </div>
            </div>
        </div>
        <div>
            <?php foreach ($transactions as $transaction) { ?>
                <!-- List of transactions begins -->
                <div class="list-item clearfix">
                    <div class="list-container clearfix">
                        <div class="col-dt-3 col-tb-3 col-mb-3">
                            <div class="list-item-content">
                                <?= $transaction->id; ?>
                                <div>
                                    <?php if (Auth::user()->roleId === 1) { ?>
                                        <a href="/admin/transactions/<?= $transaction->id; ?>">
                                            View</a>
                                    <?php } else if (Auth::user()->roleId === 2) { ?>
                                        <a href="/dashboard/transactions/<?= $transaction->id; ?>">
                                            View</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-dt-3 col-tb-3 col-mb-3">
                            <div class="list-item-content">
                                <?= $transaction->packageId; ?>
                            </div>
                        </div>
                        <div class="col-dt-3 col-tb-3 col-mb-3">
                            <div class="list-item-content">
                                <?= $transaction->customer->firstName; ?> <?= $transaction->customer->lastName; ?>
                            </div>
                        </div>
                        <div class="col-dt-3 col-tb-3 col-mb-3">
                            <div class="list-item-content">
                                $<?= money_format('%i', $transaction->cost); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>