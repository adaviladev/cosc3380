<?php getHeader(); ?>
	<!-- View for /contact page, this view allows any user (logged in or not) to
	send a question/comment to the assigned email address for contact at prostoffice.pro-->
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Contact Us</h2>
				<!-- Input begins -->
				<?php if( isset( $emailStatus ) ) { ?>
					<div class="success-message">
						<p>Message success</p>
					</div>
				<?php } else if( isset( $emailStatus ) && !$emailStatus ) { ?>
					<div class="errors">
						<p>An error occurred. Please try again.</p>
					</div>
				<?php } ?>
				<form action="/contact" method="post">
					<div class="field-container clearfix required">
						<label for="firstName">First Name</label>
						<input id="firstName" name="firstName" class="" value="" required>
					</div>
					<div class="field-container clearfix required">
						<label for="lastName">Last Name</label>
						<input id="lastName" name="lastName" class="" value="" required>
					</div>
					<div class="field-container validate clearfix required">
						<label for="email">Email</label>
						<input id="email" type="email" name="email" class="" value="" required>
					</div>
					<div class="field-container clearfix required">
						<label for="postOfficeSelector">Your Local ProstOffice (Optional)</label>
						<?php if( ! empty( $postOffices ) ) { ?>
							<select id="postOfficeSelector" name="postOfficeSelector" required>
								<option disabled selected value=""></option>
								<?php foreach( $postOffices as $postOffice ) { ?>
									<option name="PostOffice" value="<?= $postOffice->name; ?>"><?= $postOffice->name; ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>
					<div class="field-container validate clearfix required">
						<!-- Text area -->
						<label for="message">What is your question or comment?</label>
						<textarea id="message" type="text" name="message" class="" required></textarea>
					</div>
					<button name="submit" value="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php getFooter(); ?>