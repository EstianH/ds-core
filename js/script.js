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


/*
████████  █████  ██████  ███████
   ██    ██   ██ ██   ██ ██
   ██    ███████ ██████  ███████
   ██    ██   ██ ██   ██      ██
   ██    ██   ██ ██████  ███████
*/
jQuery( document ).ready( function() {
	jQuery(document).on( 'click', '.ds-tab-nav:not( .ds-tab-nav-link )', function( e ) {
		e.preventDefault();

		var clicked_nav        = jQuery( this ),
				clicked_nav_parent = jQuery( this ).parent( '.ds-tab-nav-wrapper' ),
				clicked_tab        = jQuery( this ).attr( 'href' ),
				active_nav         = jQuery( clicked_nav_parent ).children( '.active' )[0],
				active_tab         = jQuery( active_nav ).attr( 'href' ),
				animation_time     = (
					true === jQuery( clicked_nav_parent ).hasClass( 'ds-tab-nav-wrapper-animate' )
					? 400
					: 0
				);
		
		jQuery( active_nav ).removeClass( 'active' );
		jQuery( clicked_nav ).addClass( 'active' );

		jQuery( active_tab ).stop( true ).slideUp( animation_time, function() {
			jQuery( active_tab ).removeClass( 'active' );

			jQuery( clicked_tab ).stop( true ).slideDown( animation_time, function() {
				jQuery( clicked_tab ).addClass( 'active' );
			} );
		} );
	} );
} );
