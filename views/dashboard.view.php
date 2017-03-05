<?php getHeader(); ?>

	<?php if( ! empty( $user ) ) { ?>
		<div class="row">
			<div class="container">
				<h1>Lato Welcome, <?= $user->firstName ?> <?= $user->lastName ?></h1>
			</div>
			<!-- /.container -->
		</div>
		<!-- /.row -->
	<?php } ?>
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