

<?php //dd($userState);
	getHeader();
	$emailClass = (isset($errors['email']))?'invalid':'';
?>



<div class="row">
	<div class="container">
		<div class="form-wrapper">
			<h2>Account Info</h2>
			<form action="/register" method="post"> <!-- change /register -->
				<div class="field-container clearfix">
					<label for="firstName">First Name</label>
					<input type="text" name="firstName" class="valid fade-in" value= <?=$user->firstName;?> disabled>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="lastName">Last name</label>
					<input type="text" name="lastName" class="valid fade-in" value=<?=$user->lastName;?> disabled>
				</div>
				<!-- /.field-container -->
				<div class="field-container validate clearfix">
					<label for="email" class="email">Email</label>
					<input type="text" name="email" value=<?=$user->email?> class="<?= $emailClass; ?> valid fade-in" disabled>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="address">Address</label>
					<input type="text" name="address" class="valid fade-in" value=<?=$address->street?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix">
					<label for="city">City</label>
					<input type="text" name="city" class="valid fade-in" value=<?=$address->city?>>
				</div>
				<!-- /.field-container -->
				<div class="field-container clearfix" >
					<label for="StateSelector" class="filled">State</label>
					<?php if( ! empty( $states ) ) { ?>
						<select name="stateId" id="StateSelector" class="valid">
							<?php
								foreach( $states as $state ) {
									if( $state->id == $userState->id ) {
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
				<!-- /#StateSelector -->
				<div class="field-container clearfix">
					<label for="zipCode">Zip Code</label>
					<input type="text" name="zipCode" class='valid fade-in' value=<?=$address->zipCode?>>
				</div>
				<!-- /.field-container -->
				<a class="button" type="submit">Change Address</a>
				<a href="/account/info/password" class="button">Change Password</a>
			</form>
		</div>
		<!-- /.form-wrapper -->
	</div>
	<!-- /.container -->
</div>
<!-- /.row -->

<?php
	getFooter();
?>
