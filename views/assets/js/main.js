(function( $ ) {
	$( document ).ready( function() {
		$( '.form-wrapper input' ).focus( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			$( this ).siblings( 'label' ).addClass( 'active' );
		} );
		$( '.form-wrapper input' ).blur( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			if( $( this ).val() ) {
				$( this ).siblings( 'label' ).addClass( 'filled' );
				$( this ).addClass( 'valid' );
			}
		});
	} );
})( jQuery );