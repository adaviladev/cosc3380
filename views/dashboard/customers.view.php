<?php
	getHeader();
	/*
	To add:
	-Fix individual costumer views

	*/
?>
	<div class="row">
		<div class="container">
			<h1>Post Office Users</h1>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<?php if( ! empty( $customers ) ) { ?>
				<div class="package-wrapper">
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