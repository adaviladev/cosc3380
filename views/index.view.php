<?php getHeader(); ?>

	<div class="row">
		<div class="container">
			<h1>Hello World!</h1>
			<h2>Hello World!</h2>
			<h3>Hello World!</h3>
			<h4>Hello World!</h4>
			<h5>Hello World!</h5>
			<h6>Hello World!</h6>
			<p>Hello World!</p>
			<?php if( ! empty( $users ) ) { ?>
				<ul>
					<?php foreach( $users as $user ) { ?>
						<li><?= $user->firstName ?></li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>

	<div class="row">
		<div class="container">
			<form method="POST" action="/users">
				<label for="name">
					Submit Name:<br>
					<input type="text" name="name"><br>
				</label>
				<button type="submit">Submit</button>
			</form>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.row -->

<?php getFooter(); ?>