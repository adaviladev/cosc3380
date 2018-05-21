<?php getHeader(); ?>

    <div class="row">
        <div class="container">
            <?php if (empty($packages)) { ?>
                No Packages to display.
            <?php } else { ?>
                <?php getPartial('packagesGrid', compact('packages')); ?>
            <?php } ?>
        </div>
    </div>

<?php getFooter(); ?>