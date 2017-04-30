<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $packages ) ) { ?>
			<?php getPartial( 'packagesGrid' , compact( 'packages' ) ); ?>
		<?php } else { ?>
			No Packages to display.
		<?php } ?>
	</div>
</div>


<?php getFooter(); ?>