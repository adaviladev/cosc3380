<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( !empty( $postOffices ) ) { ?>
			<ul>
				<?php foreach( $postOffices as $postOffice ) { ?>
					<li><?= $postOffice->name; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php getFooter(); ?>
