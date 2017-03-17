<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign In!</h2>
				<form action="/login" method="post">
					<div class="field-container validate">
						<label for="email">Email</label>
						<input type="text" name="email">
					</div>
					<!-- /.field-wrapper -->
					<div class="field-container">
						<label for="password">Password</label>
						<input type="password" name="password">
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