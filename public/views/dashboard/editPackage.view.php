<?php
	getHeader();
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<form action="/dashboard/packages/edit/<?= $package->id; ?>" method="post">
					<h2>Edit Package</h2>
					<div class="field-container">
						<label for="sender">Sender</label>
						<input id="sender" name="sender" value="<?= $package->user->firstName; ?> <?= $package->user->lastName; ?>" class="valid fade-in" disabled>
					</div>
					<!-- /.field-container -->
					<div class="field-group">
						<h5><strong>Return Address</strong></h5>
						<div class="field-container">
							<label for="returnAddressStreet">Street</label>
							<input id="returnAddressStreet" name="returnAddressStreet" value="<?= $package->returnAddress->street; ?>" class="valid fade-in" disabled>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressCity">City</label>
							<input id="returnAddressCity" name="returnAddressCity" value="<?= $package->returnAddress->city; ?>" class="valid fade-in" disabled>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressCity">State</label>
							<input id="returnAddressCity" name="returnAddressCity" value="<?= $package->returnAddress->state; ?>" class="valid fade-in" disabled>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="returnAddressZipCode">Zip Code</label>
							<input id="returnAddressZipCode" name="returnAddressZipCode" value="<?= $package->returnAddress->zipCode; ?>" class="valid fade-in" disabled>
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-group -->
					<div class="field-group">
						<h5><strong>Destination Address</strong></h5>
						<div class="field-container">
							<label for="destinationAddressStreet">Street</label>
							<input id="destinationAddressStreet" name="destinationAddressStreet" value="<?= $package->destination->street; ?>" class="valid fade-in">
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="destinationAddressCity">City</label>
							<input id="destinationAddressCity" name="destinationAddressCity" value="<?= $package->destination->city; ?>" class="valid fade-in">
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="StateSelector" class="filled">State</label>
							<?php if( ! empty( $states ) ) { ?>
								<select name="destinationAddressStateId" id="StateSelector" class="valid">
									<option disabled selected value=""></option>
									<?php
										foreach( $states as $state ) {
											if( $state->id == $package->destination->stateId ) {
												?>
												<option value="<?= $state->id ?>" selected><?= $state->state ?></option>
											<?php } else { ?>
												<option value="<?= $state->id ?>"><?= $state->state ?></option>
											<?php
											}
										}
									?>
								</select>
							<?php } ?>
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="destinationAddressZipCode">Zip Code</label>
							<input id="destinationAddressZipCode" name="destinationAddressZipCode" value="<?= $package->destination->zipCode; ?>" class="valid fade-in">
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