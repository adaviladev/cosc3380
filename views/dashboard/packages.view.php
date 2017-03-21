<?php getHeader(); ?>

<?php if( ! empty( $packages ) ) { ?>
	<div class="row">
		<div class="container">
				<div class="grid-wrapper clearfix">
					<?php foreach( $packages as $package ) { ?>
						<a href="/packages/<?= $package->id ?>" class="col-dt-4 col-tb-6 col-mb-12 grid-item clearfix">
							<div class="grid-content card-2 clearfix">
								<div class="col-dt-12 col-tb-12 col-mb-12 grid-header secondary-bg text-left">
									<h3>Order: #<?= $package->id ?></h3>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12 text-left">
									<img src="/views/assets/images/content-box.png" alt="Content Box" class="center">
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12" >
									<?= $package->user->firstName ?> <?= $package->user->lastName ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12" >
									<?= $package->destinationId ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12 text-left">
									<?= $package->packageStatus ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
							</div>
						</a>
					<?php } ?>
				</div>
		</div>
	</div>
<?php } ?>

<?php getFooter(); ?>