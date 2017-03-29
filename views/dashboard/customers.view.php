<?php
	getHeader();
	/*
	To add:
	-Fix individual costumer views

	*/
	$titles = array('User Id', 'First Name', 'Last Name', 'Email', 'Address ID');
?>
	<div class="row">
		<div class="container">
			<h1>Post Office Users</h1>
		</div>
	</div>

	<!--<div class="row">
		<div class="container">
			<div class="package-wrapper">

			</div>
		</div>
	</div> -->
	<div class="row">
		<div class="container">
			<?php if( ! empty( $customers ) ) { ?>
				<div class="package-wrapper">
					<div class="clearfix primary-bg">
						<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
							<h4>User Id</h4>
						</div>
						<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
							<h4>First Name</h4>
						</div>
						<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
							<h4>Last Name</h4>
						</div>
						<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
							<h4>Email</h4>
						</div>
						<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
							<h4>Address Id</h4>
						</div>
					</div>
					<?php foreach( $customers as $customer ) { ?>
						<a href="/users/<?= $customer->id ?>" class="package-list-item clearfix">
							<div class="clearfix">
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $customer->id ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $customer->firstName ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center" >
									<?= $customer->lastName?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center" >
									<?= $customer->email ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
								<div class="col-dt-2 col-tb-4 col-mb-6 text-center">
									<?= $customer->addressId ?>
								</div>
								<!-- /.col-dt-2 col-tb-4 col-mb-6 -->
							</div>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>


<?php
	getFooter();
?>