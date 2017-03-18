<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<?php if( !empty( $package ) ) { ?>
				<div class="package-wrapper">
					<div class="package-list-item clearfix">
						<div class="col-dt-2 text-center">
							<?= $package->id ?>
						</div>
						<!-- /.col-dt-2 -->
						<div class="col-dt-2 text-center">
							<?= $package->userId ?>
						</div>
						<!-- /.col-dt-2 -->
						<div class="col-dt-2">
							<?= $package->user->firstName ?>
						</div>
						<!-- /.col-dt-2 -->
						<div class="col-dt-2">
							<?= $package->destinationId ?>
						</div>
						<!-- /.col-dt-2 -->
						<div class="col-dt-2 text-center">
							<?= $package->packageStatus ?>
						</div>
						<!-- /.col-dt-2 -->
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>