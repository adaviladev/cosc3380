<?php getHeader(); ?>

    <div class="row">
        <div class="container">
            <h1>Transaction Info</h1>
        </div>
    </div>

<?php if (!empty($transactions)) { ?>
    <div class="row">
        <div class="container">
            <?php getPartial('accountTransactionsList', compact('transactions')); ?>
        </div>
    </div>
<?php } ?>

<?php getFooter(); ?>