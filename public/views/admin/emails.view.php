<?php
	use App\Core\Auth;
	getHeader();
?>

<?php if( ! empty( $emails ) ) { ?>
	<div class="row">
		<div class="container">
			<div class="list-wrapper card-2">
				<div class="list-header primary-bg clearfix">
					<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
						<div class="list-item-content">
							<strong>Customer Name</strong>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
					<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
						<div class="list-item-content">
							<strong>Date Added</strong>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
					<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
						<div class="list-item-content">
							<strong>Package Id</strong>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
					<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
						<div class="list-item-content">
							<strong>Status</strong>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
				</div>
				<!-- /.container -->
			<?php foreach( $emails as $email ) { ?><div class="list-item clearfix">
				<div class="list-container clearfix">
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?= $email->user->firstName ?> <?= $email->user->lastName ?>
							<div>
								<?php if( Auth::user()->roleId === 1 ) { ?>
									<a href="/admin/customer/<?= $email->user->id; ?>">Edit</a>
								<?php } else { ?>
									<a href="/dashboard/customer/<?= $email->user->id; ?>">Edit</a>
								<?php } ?>
							</div>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?php
								$date = new DateTime($email->createdAt);
								echo $date->format( 'M j, Y' );
							?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<a href="/admin/packages/<?= $email->packageId ?>">View Package</a>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
					<div class="col-dt-3 col-tb-3 col-mb-3">
						<div class="list-item-content">
							<?php if( $email->sent === 1 ) { ?>
								Sent
							<?php } else { ?>
								Queued
							<?php } ?>
						</div>
						<!-- /.list-item-content -->
					</div>
					<!-- /.col-dt-3 col-tb-3 col-mb-3 -->
				</div>
				<!-- /.list-content -->
				</div>
			<?php } ?>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->
<?php } ?>

<?php getFooter(); ?>