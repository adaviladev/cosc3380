<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign In!</h2>
				<form action="/login" method="post">
					<div class="field-container validate required">
						<label for="email">Email <span>*</span></label>
						<input type="text" name="email" required>
					</div>
					<!-- /.field-wrapper -->
					<div class="field-container required">
						<label for="password">Password <span>*</span></label>
						<input type="password" name="password" required>
					</div>
					<!-- /.field-wrapper -->
					<button type="submit">Submit</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>