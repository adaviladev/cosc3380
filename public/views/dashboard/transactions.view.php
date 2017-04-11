<?php
	getHeader();
?>

<!-- View for the transactions assigned/created to the currently logged in
user's post office location. It displays the transactions Id, package Id, customer Id
and its cost -->
<div class="row">
	<div class="container">
		<!-- Header for list table begins -->
		<div class="group-wrapper card-2 clearfix">
			<h3>Transactions</h3>
			<div class="list-wrapper card-2">
				<?php if( ! empty( $transactions ) ) { ?>
					<div class="list-header primary-bg clearfix">
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Transaction Id</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Package Id</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Customer</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Cost</strong>
							</div>
						</div>
					</div>
					<div>
						<?php foreach( $transactions as $transaction ) { ?>
							<!-- List of transactions begins -->
							<div class="list-item clearfix">
								<div class="list-container clearfix">
									<div class="col-dt-3 col-tb-3 col-mb-3">
										<div class="list-item-content">
											<?= $transaction->id; ?>
											<div>
												<a href="/dashboard/transactions/<?= $transaction->id; ?>">
													View</a>
											</div>
										</div>
									</div>
									<div class="col-dt-3 col-tb-3 col-mb-3">
										<div class="list-item-content">
											<?= $transaction->packageId; ?>
										</div>
									</div>
									<div class="col-dt-3 col-tb-3 col-mb-3">
										<div class="list-item-content">
											<?= $transaction->customer->firstName; ?> <?= $transaction->customer->lastName; ?>
										</div>
									</div>
									<div class="col-dt-3 col-tb-3 col-mb-3">
										<div class="list-item-content">
											$<?= $transaction->cost; ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
	getFooter();
?>
