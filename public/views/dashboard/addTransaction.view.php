<?php
	getHeader();
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<form action="/dashboard/transactions/add" method="post">
					<h2>Create Transaction</h2>
					<div class="field-container">
						<div class="field-container clearfix">
							<label for="sender">Customer</label>
							<?php if( ! empty( $customers ) ) { ?>
								<select id="sender" name="customerId" id="customerSelector" class="" required>
									<option disabled selected value=""></option>
									<?php
										foreach( $customers as $customer ) { ?>
											<option value="<?= $customer->id ?>"><?= $customer->firstName ?> <?= $customer->lastName ?></option>
											<?php
										}
									?>
								</select>
							<?php } ?>
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-container -->
					<div class="field-group">
						<h5><strong>Package</strong></h5>
						<div class="field-container">
							<label for="packageContent">Content</label>
							<textarea id="packageContent" name="packageContent" required></textarea>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="packageWeight">Weight</label>
							<input id="packageWeight" name="packageWeight" type="number" required>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="packagePriority">Priority</label>
							<select name="packagePriority" id="packagePriority" class="" required>
								<option disabled selected value=""></option>
								<option value="0">Normal</option>
								<option value="1">High</option>
							</select>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="packageType">Type</label>
							<?php if( ! empty( $types ) ) { ?>
								<select name="packageType" id="packageType" class="" required>
									<option disabled selected value=""></option>
									<?php foreach( $types as $type ) { ?>
										<option value="<?= $type->id ?>"><?= $type->type ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-group -->
					<div class="field-group">
						<h5><strong>Return Address</strong></h5>
						<div class="field-container">
							<label for="returnAddressStreet">Street</label>
							<input id="returnAddressStreet" name="returnAddressStreet" value="" class="" required>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressCity">City</label>
							<input id="returnAddressCity" name="returnAddressCity" value="" class="" required>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressState">State</label>
							<?php if( ! empty( $states ) ) { ?>
								<select name="returnAddressStateId" id="returnAddressState" class="" required>
									<option disabled selected value=""></option>
									<?php foreach( $states as $state ) { ?>
										<option value="<?= $state->id ?>"><?= $state->state ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressZipCode">Zip Code</label>
							<input id="returnAddressZipCode" name="returnAddressZipCode" value="" class="" required>
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-group -->
					<div class="field-group">
						<h5><strong>Destination Address</strong></h5>
						<div class="field-container">
							<label for="destinationAddressStreet">Street</label>
							<input id="destinationAddressStreet" name="destinationAddressStreet" value="" class="" required>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="destinationAddressCity">City</label>
							<input id="destinationAddressCity" name="destinationAddressCity" value="" class="" required>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="StateSelector" class="">State</label>
							<?php if( ! empty( $states ) ) { ?>
								<select name="destinationAddressStateId" id="StateSelector" class="" required>
									<option disabled selected value=""></option>
									<?php foreach( $states as $state ) { ?>
										<option value="<?= $state->id ?>"><?= $state->state ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="destinationAddressZipCode">Zip Code</label>
							<input id="destinationAddressZipCode" name="destinationAddressZipCode" value="" class="" required>
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-group -->
					<button>Update</button>
				</form>
			</div>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php
	getFooter();
?>