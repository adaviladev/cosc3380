<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign up!</h2>
				<form action="/register" method="post">
					<div class="field-container clearfix valid">
						<label for="firstName">First Name</label>
						<input type="text" name="firstName" class="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix error">
						<label for="lastName">Last name</label>
						<input type="text" name="lastName" class="">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="password">Password</label>
						<input type="password" name="password">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="email" class="email">Email</label>
						<input type="text" name="email">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="address">Address</label>
						<input type="text" name="address">
					</div>
					<!-- /.field-container -->
					<div class="field-container clearfix">
						<label for="city">City</label>
						<input type="text" name="city">
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
						<input type="text" name="zipCode">
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