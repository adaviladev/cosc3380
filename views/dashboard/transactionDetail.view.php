<?php
	getHeader();
?>

<div class="row">
	<div class="container">
		<h1>Transaction Info</h1>
	</div>
</div>

<div class="row">
	<div class="container">
		<?php if( !empty( $transaction ) ) { ?>
			<div class="package-wrapper">
				<div class="clearfix primary-bg">
					<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
						<h4>Transaction Id</h4>
					</div>
					<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
						<h4>Package Id</h4>
					</div>
					<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
						<h4>Customer Id</h4>
					</div>
					<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
						<h4>Cost</h4>
					</div>
				</div>
				<div class="package-list-item clearfix">
					<div class="col-dt-2 text-center">
						<?= $transaction->id ?>
					</div>
					<!-- /.col-dt-2 -->
					<div class="col-dt-2 text-center">
						<?= $transaction->packageId ?>
					</div>
					<!-- /.col-dt-2 -->
					<div class="col-dt-2 text-center">
						<?= $transaction->customerId ?>
					</div>
					<!-- /.col-dt-2 -->
					<div class="col-dt-2 text-center">
						$<?= $transaction->cost ?>
					</div>
					<!-- /.col-dt-2 -->
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php
	getFooter();
?>


