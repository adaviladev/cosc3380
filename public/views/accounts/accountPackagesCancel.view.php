<?php getHeader() ?>

<?php if( $package->packageStatus !== 1 ) { ?>
	<h5>We're sorry. This package has left processing and therefore can not be cancelled.</h5>
	<br/>
	<a href="/account/packages">Return to Packages.</a>
<?php } else if( $package->userId != $user->id ) {
	redirect( 'account/packages' );
} else if( $package->userId == $user->id && $package->packageStatus == 1 ) { ?>
	<h1>You are about to cancel the following package. Please assure it is the correct one before you submit.</h1>
	<div class="row">
		<form action="/account/packages/cancel/<?= $package->id; ?>" method="post">
			<div class="container">
				<?php if( ! empty( $package ) ) { ?>
					<div class="package-wrapper">
						<div class="package-item card-2 clearfix">
							<div class="package-detail-content">
								<div class="col-dt-12 col-tt-12 col-mb-12 text-left primary-bg">
									<div class="package-detail-header">
										<p>
											Order #<?= $package->id; ?><br/>
											Sender: <?= $package->user->firstName; ?> <?= $package->user->lastName; ?>

										</p>
									</div>
									<!-- /.package-detail-header -->
								</div>
								<!-- /.col-dt-12 col-tt-12 col-mb-12 text-left -->
								<div class="col-dt-12">
									<img src="/views/assets/images/content-box.png" alt="Package contents" class="center">
								</div>
								<!-- /.col-dt-12 -->
								<div class="col-dt-12 text-left clearfix">
									<div class="package-detail-info clearfix">
										<p><?= $package->status->type; ?></p>
										<div class="col-dt-6 col-mb-12">
											<p>Origin:</p>
											<?= $package->returnAddress->street; ?>,<br/>
											<?= $package->returnAddress->city; ?>, <?= $package->returnAddress->state; ?> <?= $package->returnAddress->zipCode; ?>
										</div>
										<!-- /.col-dt-12 -->
										<div class="col-dt-6 col-mb-12">
											<p>Destination:</p>
											<?= $package->destination->street; ?>,<br/>
											<?= $package->destination->city; ?>, <?= $package->destination->state; ?> <?= $package->destination->zipCode; ?>
										</div>
										<!-- /.col-dt-12 -->
										<input type="hidden" name="packageId" value="<?= $package->id ?>">
										<button type="submit">Confirm Cancellation</button>
									</div>
									<!-- /.package-detail-info -->
								</div>
								<!-- /.col-dt-12 -->
							</div>
							<!-- /.package-content -->
						</div>
					</div>
				<?php } else {
					redirect( '/account/packages' );
				} ?>
			</div>
		</form>
	</div>

<?php } ?>
<?php getFooter() ?>
