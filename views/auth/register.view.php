<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign up!</h2>
				<form action="/register" method="post">
					<div class="field-container clearfix">
						<label for="firstName">
							First Name
							<input type="text" name="firstName" placeholder="First Name">
						</label>
					</div>
					<?php if( true ) { ?>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="lastName">
								<input type="text" name="lastName" placeholder="Last name">
							</label>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="password">
								<input type="password" name="password" placeholder="Password">
							</label>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="email" class="email">
								<input type="text" name="email" placeholder="Email">
							</label>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="address">
								<input type="text" name="address" placeholder="Address">
							</label>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="city">
								<input type="text" name="city" placeholder="City">
							</label>
						</div>
						<!-- /.field-container -->
						<div class="field-container clearfix">
							<label for="StateSelector">
								<?php if( ! empty( $states ) ) { ?>
									<select name="stateId" id="StateSelector">
										<?php foreach( $states as $state ) { ?>
											<option value="<?= $state->id ?>"><?= $state->state ?></option>
										<?php } ?>
									</select>
								<?php } ?>
							</label>
						</div>
						<!-- /.field-container -->
						<!-- /#StateSelector -->
						<div class="field-container clearfix">
							<label for="zipCode">
								<input type="text" name="zipCode" placeholder="Zip Code">
							</label>
						</div>
						<!-- /.field-container -->
						<button type="submit">Submit</button>
					<?php } ?>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>