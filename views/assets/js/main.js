(function( $ ) {
	$( document ).ready( function() {
		if( $( '.form-wrapper input.valid' ).attr( 'value' ) !== '' ) {
			$( '.form-wrapper input.valid' ).siblings( 'label' ).addClass( 'filled' );
		}
		$( '.form-wrapper input,.form-wrapper select' ).focus( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			$( this ).siblings( 'label' ).addClass( 'active' );
		} );
		$( '.form-wrapper input,.form-wrapper select' ).blur( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			if( !$( this ).parent().hasClass('validate') && $( this ).val() ) {
				$( this ).siblings( 'label' ).addClass( 'filled' );
				$( this ).addClass( 'valid' );
			}


		} );
		$( '.validate input[name="email"]' ).on( 'keyup change', function() {
			var isValid = validateEmail( $( this ).val() );
			if( isValid ) {
				$( this ).removeClass( 'dirty' );
				$( this ).addClass( 'valid' );
			} else {
				$( this ).siblings( 'label' ).removeClass( 'valid' ).addClass( 'filled' );
				$( this ).addClass( 'dirty' );
			}
		} );

		function validateEmail( mail ) {
			return ( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( mail ) );
		}
	} );
})( jQuery );