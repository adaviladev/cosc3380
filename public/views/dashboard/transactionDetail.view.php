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

	<!-- View for single transaction's details -->
	<div class="row">
		<div class="container">
			<?php if( ! empty( $transaction ) ) { ?>
				<div class="package-wrapper">
					<div class="package-item card-2 clearfix">
						<div class="package-detail-content">
							<div class="col-dt-12 col-tt-12 col-mb-12 text-left primary-bg">
								<div class="package-detail-header">
									<p>
										Order #<?= $transaction->id; ?><span class="float-right">
										<?php
											$date = new DateTime($transaction->createdAt);
											echo $date->format( 'M j, Y' );
										?>
										</span><br/>
										Cashier: <?= $transaction->employee->firstName; ?> <?= $transaction->employee->lastName; ?>

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
									<p><strong><?= $transaction->package->status; ?> - $<?= money_format( '%i' , $transaction->cost ); ?></strong></p>
									<div class="col-dt-6 col-mb-12">
										<p>Origin:</p>
										<?= $transaction->package->returnAddress->street; ?>,<br/>
										<?= $transaction->package->returnAddress->city; ?>, <?= $transaction->package->returnAddress->state; ?> <?= $transaction->package->returnAddress->zipCode; ?>
									</div>
									<!-- /.col-dt-12 -->
									<div class="col-dt-6 col-mb-12">
										<p>Destination:</p>
										<?= $transaction->package->destination->street; ?>,<br/>
										<?= $transaction->package->destination->city; ?>, <?= $transaction->package->destination->state; ?> <?= $transaction->package->destination->zipCode; ?>
									</div>
									<!-- /.col-dt-12 -->
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