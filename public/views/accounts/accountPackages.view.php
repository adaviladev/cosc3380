<?php getHeader(); ?>
<?php if( ! empty( $packages ) ) { ?>
	<div class="row">
		<div class="container">
			<div class="grid-wrapper clearfix">
				<?php getPartial( "accountPackagesGrid" ,
				                  compact( 'packages' ) ); ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="container">
		<div class="paragraph-breaking">
			There is no package history for your account. If you believe this is an error or want to find
			out how you can send a package, please <a href="/contact">contact us</a>.
		</div>
	</div>
<?php } ?>

<?php getFooter(); ?>
