(function( $ ) {
	$( document ).ready( function() {
		console.log( 'hit' );
		$( '.form-wrapper input' ).focus( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			$( this ).siblings( 'label' ).addClass( 'active' );
		} );
	} );
})( jQuery );