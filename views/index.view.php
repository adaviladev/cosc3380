<?php getHeader(); ?>

	<div class="row">
		<div class="container">
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