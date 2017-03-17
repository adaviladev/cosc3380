<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $packages ) ) { ?>
				<div class="package-wrapper">
					<?php foreach( $packages as $package ) { ?>
						<a href="/packages/<?= $package->id ?>" class="package-list-item clearfix">
							<div class="clearfix">
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $package->id ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $package->userId ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6" >
									<?= $package->user->firstName ?> <?= $package->user->lastName ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6" >
									<?= $package->destinationId ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $package->packageStatus ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
							</div>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>