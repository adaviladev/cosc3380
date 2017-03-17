<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $postOffices ) ) { ?>
			<h1>Locations</h1>
			<div class="location-wrapper clearfix">
				<?php foreach( $postOffices as $postOffice ) { ?>
					<div class="col-dt-4 col-tb-6 col-mb-12">
						<div class="location-content card-1">
							<div class=" col-dt-12 location-title">
								<h2><?= $postOffice->name; ?></h2>
							</div>
							<!-- /.location-title -->
							<div class="location-address clearfix">
								<div class="col-dt-12">
									<p>
										<?= $postOffice->address; ?><br/>
										<?= $postOffice->city; ?>, <?= $postOffice->state; ?> <?= $postOffice->zipCode; ?>
										<br/>
									</p>
								</div>
								<!-- /.col-dt-12 -->
							</div>
							<!-- /.location-detail -->
						</div>
						<!-- /.location-content -->
					</div>
					<!-- /.col-dt-4 location-wrapper -->
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php getFooter(); ?>
