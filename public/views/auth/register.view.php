<?php
	getHeader();
	$emailClass = (isset($errors['email']))?'invalid':'';
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign up!</h2>
				<form action="/register" method="post">
					<div class="field-container clearfix required">
						<label for="firstName" class="required">First Name <span>*</span></label>
						<input type="text" name="firstName" class="" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix required">
						<label for="lastName">Last name <span>*</span></label>
						<input type="text" name="lastName" class="" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix required">
						<label for="password" class="required">Password <span>*</span></label>
						<input type="password" name="password" value="" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container validate clearfix required">
						<label for="email" class="email required">Email <span>*</span></label>
						<input type="email" name="email" value="" class="<?= $emailClass; ?>" required>
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="address">Address</label>
						<input type="text" name="address" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="city">City</label>
						<input type="text" name="city" value="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="StateSelector">State</label>
						<?php if( ! empty( $states ) ) { ?>
							<select name="stateId" id="StateSelector">
								<option disabled selected value=""></option>
								<?php foreach( $states as $state ) { ?>
									<option value="<?= $state->id ?>"><?= $state->state ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>
					<!-- /.field-container -->
					<!-- /#StateSelector -->
					<div class="field-container clearfix">
						<label for="zipCode">Zip Code</label>
						<input type="text" name="zipCode" value="">
					</div>
					<!-- /.field-container -->
					<button type="submit">Submit</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>