<?php
	getHeader();
?>
<!-- View for a single user details -->
<div class="row">
	<div class="container">
		<div class="group-wrapper card-2 clearfix">
			<h3>Customer Details for <?= $user->firstName ?> <?= $user->lastName ?></h3>
			<div class="list-wrapper card-2">
				<?php if(! empty($user)) { ?>
					<div class="list-header primary-bg clearfix">
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>User Id</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>First Name</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Last Name</strong>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
							<div class="list-item-content">
								<strong>Email</strong>
							</div>
						</div>
					</div>
					<div>
						<div class="list-item clearfix">
							<div class="list-container clearfix">
								<div class="col-dt-3 col-tb-3 col-mb-3">
									<div class="list-item-content">
										<?= $user->id ?>
									</div>
								</div>
								<div class="col-dt-3 col-tb-3 col-mb-3">
									<div class="list-item-content">
										<?= $user->firstName ?>
									</div>
								</div>
								<div class="col-dt-3 col-tb-3 col-mb-3">
									<div class="list-item-content">
										<?= $user->lastName ?>
									</div>
								</div>
								<div class="col-dt-3 col-tb-3 col-mb-3">
									<div class="list-item-content">
										<?= $user->email ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php
	getFooter();
?>


