(function( $ ) {
	$( document ).ready( function() {
		if( $( '.form-wrapper input.valid' ).attr( 'value' ) !== '' ) {
			$( '.form-wrapper input.valid' ).siblings( 'label' ).addClass( 'filled' );
		}
		$( '.form-wrapper input,.form-wrapper select' ).focus( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			$( this ).siblings( 'label' ).addClass( 'active' );
		} );
		$( '.form-wrapper input,.form-wrapper textarea' ).blur( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			if( !$( this ).parent().hasClass( 'validate' ) && $( this ).val() ) {
				if( $( this ).attr( 'type' ) !== 'email' ) {
					$( this ).siblings( 'label' ).addClass( 'filled' );
					$( this ).addClass( 'valid' );
				}
			}
			if( $( this ).val().length === 0 ) {
				$( this ).siblings( 'label' ).removeClass( 'filled' );
				$( this ).removeClass( 'valid' );
				$( this ).addClass( 'dirty' );
			}
		} );
		$( '.form-wrapper select' ).blur( function() {
			$( '.form-wrapper label' ).removeClass( 'active' );
			if( $( this ).val() === null ) {
				$( this ).siblings( 'label' ).removeClass( 'filled' );
				$( this ).removeClass( 'valid' );
				$( this ).addClass( 'dirty' );
			}
		} );
		$( '.form-wrapper .required input[type="text"],.form-wrapper .required input[type="password"],.form-wrapper select' ).on( 'keyup change', function() {
			if( $( this ).val().length === 0 ) {
				$( this ).siblings( 'label' ).removeClass( 'filled' );
				$( this ).removeClass( 'valid' );
				$( this ).addClass( 'dirty' );
			} else if( $( this ).val().length !== 0 ) {
				$( this ).siblings( 'label' ).addClass( 'filled' );
				$( this ).addClass( 'valid' );
				$( this ).removeClass( 'dirty' );
			}
		} );
		$( '.validate input[name="email"]' ).on( 'keyup change', function() {
			var isValid = validateEmail( $( this ).val() );
			if( isValid ) {
				$( this ).removeClass( 'dirty' );
				$( this ).addClass( 'valid' );
				$( '.form-wrapper button' ).prop( 'disabled', false );
			} else if( $( this ).val() !== '' ) {
				$( this ).siblings( 'label' ).removeClass( 'valid' ).addClass( 'filled' );
				$( this ).addClass( 'dirty' );
				$( '.form-wrapper button' ).prop( 'disabled', true );
			} else {
				$( this ).addClass( 'dirty' );
				$( '.form-wrapper button' ).prop( 'disabled', true );
			}
		} );

		function validateEmail( mail ) {
			return ( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( mail ) );
		}

		$( ".nav-trigger" ).click( function( event ) {
			event.preventDefault();
			if( ( $( this ).hasClass( "is-active" ) ) ) {
				$( this ).removeClass( "is-active" );
				$( 'body' ).removeClass( "open-menu" );
			} else {
				$( this ).addClass( "is-active" );
				$( 'body' ).addClass( "open-menu" );
			}
		} );
	} );
})( jQuery );