<?php getHeader(); ?>

<div class="row">
	<div class="container">
		<?php if( ! empty( $postOffices ) ) { ?>
			<h1>Locations</h1>
			<div class="list-wrapper clearfix">
				<?php foreach( $postOffices as $postOffice ) { ?>
					<div class="col-dt-4 col-tb-6 col-mb-12">
						<div class="list-content card-1">
							<div class=" col-dt-12 list-header secondary-bg">
								<h2><?= $postOffice->name; ?></h2>
							</div>
							<!-- /.location-title -->
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
							<!-- /.list-detail -->
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
