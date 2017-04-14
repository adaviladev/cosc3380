<div class="list-wrapper card-2">
	<?php if( ! empty( $customers ) ) { ?>
		<div class="list-header primary-bg clearfix">
			<!-- Header for the list begins -->
			<div class="col-dt-2 col-tb-2 col-mb-2 no-margin">
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
			<div class="col-dt-4 col-tb-4 col-mb-4 no-margin">
				<div class="list-item-content">
					<strong>Email</strong>
				</div>
			</div>
		</div>
		<div>
			<?php foreach( $customers as $customer ) { ?>
				<!-- List of users begins -->
				<div class="list-item clearfix">
					<div class="list-container clearfix">
						<div class="col-dt-2 col-tb-2 col-mb-2">
							<div class="list-item-content">
								<?= $customer->id ?>
								<div>
									<a href="/dashboard/customers/<?= $customer->id ?>">
										View</a>
								</div>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3">
							<div class="list-item-content">
								<?= $customer->firstName ?>
							</div>
						</div>
						<div class="col-dt-3 col-tb-3 col-mb-3">
							<div class="list-item-content">
								<?= $customer->lastName ?>
							</div>
						</div>
						<div class="col-dt-4 col-tb-4 col-mb-4">
							<div class="list-item-content">
								<?= $customer->email ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>