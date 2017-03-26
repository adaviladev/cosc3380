<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $postOffices ) ) { ?>
			<h1>Locations</h1>
			<div class="list-wrapper clearfix">
				<?php foreach( $postOffices as $postOffice ) { ?>
					<div class="grid-item col-dt-4 col-tb-6 col-mb-12">
						<div class="grid-item-container card-1">
							<div class=" col-dt-12 list-header secondary-bg">
								<div class="grid-item-content">
									<h3><?= $postOffice->name; ?></h3>
								</div>
								<!-- /.grid-item-content -->
							</div>
							<!-- /.location-title -->
							<div class="grid-item-content">
								<div class="list-address clearfix">
									<div class="col-dt-12">
										<p>
											<?= $postOffice->address; ?><br/>
											<?= $postOffice->city; ?>, <?= $postOffice->state; ?> <?= $postOffice->zipCode; ?>
											<br/>
										</p>
									</div>
									<!-- /.col-dt-12 -->
								</div>
								<!-- /.list-address -->
							</div>
							<!-- /.grid-item-content -->
						</div>
						<!-- /.list-content -->
					</div>
					<!-- /.col-dt-4 list-wrapper -->
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php getFooter(); ?>
