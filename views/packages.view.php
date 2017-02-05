<?php
	require 'partials/header.php';
?>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $packages ) ) { ?>
				<div class="package-wrapper">
					<?php foreach( $packages as $package ) { ?>
						<div class="package-list-item clearfix">
							<div class="one_fifth float-left text-center">
								<?= $package->id ?>
							</div>
							<!-- /.one_fifth float-left -->
							<div class="one_fifth float-left text-center">
								<?= $package->user_id ?>
							</div>
							<!-- /.one_fifth float-left -->
							<div class="one_fifth float-left">
								<?= $package->user->username ?>
							</div>
							<!-- /.one_fifth float-left -->
							<div class="one_fifth float-left">
								<?= $package->destination ?>
							</div>
							<!-- /.one_fifth float-left -->
							<div class="one_fifth float-left text-center">
								<?= $package->status ?>
							</div>
							<!-- /.one_fifth float-left -->
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>

<?php
	require 'partials/footer.php';
?>