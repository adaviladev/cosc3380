<div class="grid-wrapper clearfix">
	<?php foreach( $packages as $package ) { ?>
		<div class="col-dt-4 col-tb-6 col-mb-12 grid-item clearfix">
			<div class="grid-item-container card-2 clearfix">
				<a href="/packages/<?= $package->id; ?>">
					<div class="col-dt-12 col-tb-12 col-mb-12 grid-header secondary-bg text-left">
						<div class="grid-item-content">
							<h3>Order: #<?= $package->id; ?></h3>
						</div>
						<!-- /.grid-item-content -->
					</div>
					<!-- /.col-dt-12 col-tb-12 col-mb-12 -->
					<div class="clearfix grid-item-content">
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
					</div>
					<!-- /.grid-item-content -->
				</a>
			</div>
		</div>
	<?php } ?>
</div>