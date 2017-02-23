<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $user ) ) { ?>
				<ul>
					<?php foreach( $user->packages as $package ) { ?>
						<li><?= $package->destination ?></li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>