<?php getHeader(); ?>

<?php if( ! empty( $packages ) ) { ?>
	<div class="row">
		<div class="container">
			<?php getPartial( 'packagesGrid' , compact( 'packages' ) ); ?>
		</div>
	</div>
<?php } ?>

<?php getFooter(); ?>