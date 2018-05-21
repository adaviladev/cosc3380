<?php getHeader(); ?>
<!-- View for a single user details -->
<div class="row">
    <div class="container">
        <div class="group-wrapper card-2 clearfix">
            <h3>Customer Details for <?= $customer->firstName ?> <?= $customer->lastName ?></h3>
            <?php getPartial('packagesGrid', compact('customer', 'packages')); ?>
        </div>
    </div>
</div>

<?php getFooter(); ?>


