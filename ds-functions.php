<?php
/**
 * Maybe Enqueue DS Core asset files on the front-end.
 */
function ds_enqueue_assets_maybe() {
	$dsc_settings = get_option( 'dsc_settings' );

	if ( !empty( $dsc_settings['frontend']['include'] ) ) {
		wp_enqueue_style (  'dsc-style',  DSC_ASSETS . 'css/style.css', array(), DSC_VERSION );
		wp_enqueue_script ( 'dsc-script', DSC_ASSETS . 'js/script.js',	array(), DSC_VERSION );

		unset( $dsc_settings['frontend']['include'] );

		// Enqueue inline styles that override defaults.
		if ( !empty( $dsc_settings['frontend'] ) ) {
			if ( !empty( $dsc_settings['frontend']['gutter-size'] ) ) {
				$gutter_size = floatval( $dsc_settings['frontend']['gutter-size'] );
				$gutter_size_half = $gutter_size / 2;
				$unit = str_replace( $gutter_size, '', $dsc_settings['frontend']['gutter-size'] );
				$unit = ( !empty( $unit ) ? $unit : 'px' );

				$styles = '.ds-container {
					padding-left: ' . $gutter_size_half . $unit . ';
					padding-right: ' . $gutter_size_half .  $unit . ';
				}';

				$styles .= '.ds-container .ds-row {
					margin-left: -' . $gutter_size_half .  $unit . ';
					margin-right: -' . $gutter_size_half .  $unit . ';
				}';

				$styles .= '.ds-container .ds-row .ds-col,';

				for ( $i = 1; $i <= 12; $i++ ) {
					$styles .= '.ds-container .ds-row .ds-col-' . $i . ',';
				}

				$styles = substr( $styles, 0, -1 ); // remove last comma.

				$styles .= '{
					padding-left: ' . $gutter_size_half .  $unit . ';
					padding-right: ' . $gutter_size_half .  $unit . ';
				}';
			}

			wp_add_inline_style( 'dsc-style', $styles );
		}
	}
}
