jQuery( document ).ready( function() {
	jQuery( '.ds-checkbox.active + .ds-input-toggle-box' ).show();

	jQuery( '.ds-checkbox > input' ).on( 'change', function() {
		var parent = jQuery( this ).parent();

		parent.toggleClass( 'active' );
		parent.siblings( '.ds-input-toggle-box' ).slideToggle();
	} );
} );
