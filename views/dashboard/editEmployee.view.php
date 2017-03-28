<?php
	getHeader();
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<form action="/dashboard/employees/<?= $employee->id; ?>" method="post">
					<div class="field-container">
						<label for="sender">Name</label>
						<input type="text" name="sender" value="<?= $employee->firstName; ?> <?= $employee->lastName; ?>" class="valid fade-in" disabled>
					</div>
					<!-- /.field-container -->
					<div class="field-container">
						<label for="sender">Location</label>
						<input type="text" name="sender" value="<?= $employee->location->name; ?>" class="valid fade-in" disabled>
					</div>
					<!-- /.field-container -->
					<div class="field-group">
						<h5><strong>Address</strong></h5>
						<div class="field-container">
							<label for="addressStreet">Street</label>
							<input type="text" name="addressStreet" value="<?= $employee->address->street; ?>" class="valid fade-in">
						</div>
						<!-- /.field-container -->
						<div class="field-container">
							<label for="addressCity">City</label>
							<input type="text" name="addressCity" value="<?= $employee->address->city; ?>" class="valid fade-in">
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="StateSelector" class="filled">State</label>
							<?php if( ! empty( $states ) ) { ?>
								<select name="addressStateId" id="StateSelector" class="valid">
									<option disabled selected value=""></option>
									<?php
										foreach( $states as $state ) {
											if( $state->id == $employee->address->stateId ) {
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
							<label for="addressZipCode">Zip Code</label>
							<input type="text" name="addressZipCode" value="<?= $employee->address->zipCode; ?>" class="valid fade-in">
						</div>
						<!-- /.field-container -->
					</div>
					<!-- /.field-group -->
					<div class="field-container">
						<label for="deleteEmployee" class="checkbox-label">
							<?php if( $employee->active == 1 ) { ?>
								<input type="checkbox" name="deleteEmployee">Delete
							<?php } else { ?>
								<input type="checkbox" name="addEmployee">Add
							<?php } ?>
							<eletel>
					</div>
					<!-- /.field-container -->
					<button type="submit">Update</button>
				</form>

			</div>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php
	getFooter();
?>