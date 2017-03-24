<?php getHeader(); ?>
<?php if( ! empty( $packages ) ) { ?>
	<div class="row">
		<div class="container">
			<div class="grid-wrapper clearfix">
				<?php foreach( $packages as $package ) { ?>
					<div class="col-dt-4 col-tb-6 col-mb-12 grid-item clearfix">
						<div class="grid-item-content card-2 clearfix">
							<a href="/packages/<?= $package->id; ?>">
								<div class="col-dt-12 col-tb-12 col-mb-12 grid-header secondary-bg text-left">
									<h3>Order: #<?= $package->id; ?></h3>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12 text-left">
									<img src="/views/assets/images/content-box.png" alt="Content Box" class="center">
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12">
									<?= $package->user->firstName; ?> <?= $package->user->lastName; ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12">
									<?= $package->destination->street; ?>, <br/>
									<?= $package->destination->city; ?>, <?= $package->destination->state->state; ?> <?= $package->destination->zipCode; ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
								<div class="col-dt-12 col-tb-12 col-mb-12 text-left">
									<?= $package->status->type; ?>
								</div>
								<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php }
else { ?>
	<div class = paragraph-breaking>
		There is no package history for your account. If you believe this is an error or want to find
		out how you can send a package, please <a href="/contact">contact us</a>.
	</div>
<?php } ?>

<?php getFooter(); ?>
