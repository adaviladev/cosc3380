<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $postOffices ) ) { ?>
			<h1>Locations</h1>
			<?php getPartial( 'locationsGrid' , compact( 'postOffices' ) ); ?>
		<?php } ?>
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php getFooter(); ?>
