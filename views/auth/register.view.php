<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign up!</h2>
				<form action="/register" method="post">
					<label for="firstName">
						<input type="text" name="firstName" placeholder="First name">
					</label>
					<label for="lastName">
						<input type="text" name="lastName" placeholder="Last name">
					</label>
					<label for="password">
						<input type="password" name="password" placeholder="Password">
					</label>
					<label for="email">
						<input type="text" name="email" placeholder="Email">
					</label>
					<label for="address">
						<input type="text" name="address" placeholder="Address">
					</label>
					<label for="city">
						<input type="text" name="city" placeholder="City">
					</label>
					<label for="StateSelector">
						<?php if( ! empty( $states ) ) { ?>
							<select name="state" id="StateSelector">
								<?php foreach( $states as $state ) { ?>
									<option value="<?= $state->id ?>"><?= $state->state ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</label>
					<!-- /#StateSelector -->
					<label for="zipCode">
						<input type="text" name="zipCode" placeholder="Zip Code">
					</label>
					<button type="submit">Submit</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>