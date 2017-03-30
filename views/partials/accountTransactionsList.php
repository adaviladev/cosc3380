<div class="list-wrapper card-2">
	<div class="list-header primary-bg clearfix">
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Order #</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Order Date</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Package #</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
		<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
			<div class="list-item-content">
				<strong>Cost</strong>
			</div>
			<!-- /.list-item-content -->
		</div>
		<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
	</div>
	<!-- /.container -->
	<div>
		<?php foreach( $transactions as $transaction ) { ?>
			<div class="list-item secondary-bg clearfix">
				<div class="list-container clearfix">
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $transaction->id ?>
							<div>
								<a href="/account/transactions/<?= $transaction->id; ?>">View</a>
							</div>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?php
								$date = new DateTime($transaction->createdAt);
								echo $date->format( 'M j, Y' );
							?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $transaction->id; ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $transaction->cost; ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
				</div>
				<!-- /.list-content -->
			</div>
		<?php } ?>
	</div>
</div>
<!-- /.list-wrapper -->