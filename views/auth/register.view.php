<?php
	require 'views/partials/header.php';
?>

	<div class="row">
		<div class="container">
			<div class="form-wrapper">
				<h2>Sign up!</h2>
				<form action="/register" method="post">
					<label>
						<input type="text" name="username" placeholder="Username">
					</label>
					<label for="password">
						<input type="password" name="password" placeholder="Password">
					</label>
					<button type="submit">Submit</button>
				</form>
			</div>
			<!-- /.form-wrapper -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php
	require 'views/partials/footer.php';
?>