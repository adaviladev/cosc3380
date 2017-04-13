<?php
	getHeader();
	$titles = array( 'User Id' , 'First Name' , 'Last Name' , 'Email' , 'Address ID' );
?>
<!-- /customers page displays all the customers assigned to the currently
 logged in user's post office location. It displays the users' id, first name, last name
 and email address, with a link to single user's view -->
	<div class="row">
		<div class="container">
			<div class="group-wrapper card-2 clearfix">
				<h3>Customers</h3>
				<div class="list-wrapper card-2">
					<?php if( ! empty( $customers ) ) { ?>
						<div class="list-header primary-bg clearfix">
							<!-- Header for the list begins -->
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
							<?php foreach( $customers as $customer ) { ?>
								<!-- List of users begins -->
								<div class="list-item clearfix">
									<div class="list-container clearfix">
										<div class="col-dt-3 col-tb-3 col-mb-3">
											<div class="list-item-content">
												<?= $customer->id ?>
												<div>
													<a href="/users/<?= $customer->id ?>">
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
										<div class="col-dt-3 col-tb-3 col-mb-3">
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
			</div>
		</div>
	</div>


<?php
	getFooter();
?>