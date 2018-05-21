<?php getHeader(); ?>

<!-- View for the transactions assigned/created to the currently logged in
user's post office location. It displays the transactions Id, package Id, customer Id
and its cost -->
<div class="row">
    <div class="container">
        <!-- Header for list table begins -->
        <div class="group-wrapper card-2 clearfix">
            <h3>
                Transactions <span class="float-right"><a href="/dashboard/transactions/add" class="button">Create Transaction</a></span>
                <!-- /.float-right -->
            </h3>
            <?php getPartial('transactionsList', compact('transactions')); ?>
        </div>
    </div>
</div>

<?php getFooter(); ?>
