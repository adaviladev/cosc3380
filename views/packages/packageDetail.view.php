<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<?php if( !empty( $package ) ) { ?>
				<div class="package-wrapper">
					<div class="package-list-item clearfix">
						<div class="one_fifth float-left text-center">
							<?= $package->id ?>
						</div>
						<!-- /.one_fifth float-left -->
						<div class="one_fifth float-left text-center">
							<?= $package->userId ?>
						</div>
						<!-- /.one_fifth float-left -->
						<div class="one_fifth float-left">
							<?= $package->user->firstName ?>
						</div>
						<!-- /.one_fifth float-left -->
						<div class="one_fifth float-left">
							<?= $package->destinationId ?>
						</div>
						<!-- /.one_fifth float-left -->
						<div class="one_fifth float-left text-center">
							<?= $package->packageStatus ?>
						</div>
						<!-- /.one_fifth float-left -->
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>