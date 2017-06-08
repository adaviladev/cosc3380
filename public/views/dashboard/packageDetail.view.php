<?php
	use App\Core\Auth;

	getHeader();
?>

<div class="row">
	<div class="container">
		<h2>
			<?php if( Auth::user()->roleId === 1 ) { ?>
				<a href="/admin/reports" class="button primary-bg">View Reports</a>
			<?php } else if( Auth::user()->roleId === 2 ) { ?>
				<a href="/dashboard/reports" class="button primary-bg">View Reports</a>
			<?php } ?>
		</h2>
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

	<div class="row">
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
									<p><?= $package->status; ?></p>
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
									<?php if( $package->packageStatus == 1 && (Auth::user()->roleId == 2 ) ) { ?>
										<a href="/dashboard/packages/edit/<?= $package->id; ?>" class="button">Edit</a>
										<!-- /.button -->
									<?php } ?>
								</div>
								<!-- /.package-detail-info -->
							</div>
							<!-- /.col-dt-12 -->
						</div>
						<!-- /.package-content -->
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

<?php getFooter(); ?>