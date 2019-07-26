/*
██████  ██       ██████   ██████ ██   ██   ████████  ██████   ██████   ██████  ██      ███████ ██████
██   ██ ██      ██    ██ ██      ██  ██       ██    ██    ██ ██       ██       ██      ██      ██   ██
██████  ██      ██    ██ ██      █████  █████ ██    ██    ██ ██   ███ ██   ███ ██      █████   ██████
██   ██ ██      ██    ██ ██      ██  ██       ██    ██    ██ ██    ██ ██    ██ ██      ██      ██   ██
██████  ███████  ██████   ██████ ██   ██      ██     ██████   ██████   ██████  ███████ ███████ ██   ██
*/
jQuery( document ).ready( function() {
	jQuery( '.ds-block-toggler .ds-block-toggler-input' ).on( 'change', function() {
		var parent = jQuery( this ).closest( '.ds-block-toggler' );

		if ( jQuery( this ).is( ':checked' ) ) {
			parent.siblings( '.ds-block-toggler-block' ).stop( true ).slideDown( function() {
				parent.addClass( 'active' );
			} );
		} else {
			parent.siblings( '.ds-block-toggler-block' ).stop( true ).slideUp( function() {
				parent.removeClass( 'active' );
			} );
		}
	} );
} );
