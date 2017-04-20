<?php getHeader(); ?>
	<!-- View for /contact page, this view allows any user (logged in or not) to
	send a question/comment to the assigned email address for contact at prostoffice.pro-->
	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Contact Us</h2>
				<!-- Input begins -->
				<form action="/contact" method="post">
					<div class="field-container clearfix required">
						<label for="FirstName">First Name</label>
						<input id="FirstName" type="text" name="FirstName" class="" value="" required>
					</div>
					<div class="field-container clearfix required">
						<label for="LastName">Last Name</label>
						<input id="LastName" type="text" name="LastName" class="" value="" required>
					</div>
					<div class="field-container validate clearfix required">
						<label for="Email">Email</label>
						<input id="Email" type="email" name="Email" class="" value="" required>
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
						<label for="Message">What is your question or comment?</label>
						<textarea id="Message" type="text" name="Message" class="" required></textarea>
					</div>
					<button type="submit" name="submit" value="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>


<?php getFooter(); ?>