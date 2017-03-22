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
						<?= $transaction->cost ?>
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


