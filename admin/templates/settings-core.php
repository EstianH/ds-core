<?php if( !defined( 'ABSPATH' ) ) exit;

$dsc_settings = get_option( 'dsc-settings' );

$current_theme = wp_get_theme();

?>
<div class="ds-wrapper">
	<h1 class="ds-pb-2"><?php echo DSC_TITLE; ?></h1>
	<div class="wrap ds-mt-0">
		<h2 class="ds-pt-0 ds-pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
		<form method="post" action="options.php">
			<?php settings_fields( 'dsc-settings' ); ?>
			<div class="ds-row">
				<div class="ds-col ds-mb-2">
					<div class="ds-block">
						<div class="ds-block-title">
							<h2 class="ds-mt-0 ds-mb-0">
								<span class="dashicons dashicons-feedback"></span>
								<?php _e( 'Settings', 'ds-core' ); ?>
							</h2>
						</div>
						<div class="ds-block-body">
							<label class="ds-checkbox ds-input-toggle ds-mb-2<?php echo ( !empty( $dsc_settings['include_frontend'] ) ? ' active' : ''); ?>">
								<input name="dsc-settings[include_frontend]" type="checkbox" value="1"<?php echo ( !empty( $dsc_settings['include_frontend'] ) ? ' checked="checked"' : ''); ?> />
								<?php _e( 'Include the DS Core stylesheet & script on your website.', 'ds-core' ); ?>
							</label>
							<div class="ds-input-toggle-box">
								<div class="ds-mb-2">
									Some text to appear here.
								</div>
							</div>
							<div class="">
								<?php submit_button( '', 'button-primary', '', false ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if ( 'Avada' === $current_theme->template ) { ?>
				<div class="ds-row">
					<div class="ds-col ds-mb-2">
						<div class="ds-block">
							<div class="ds-block-title">
								<h2 class="ds-mt-0 ds-mb-0">
									<span class="dashicons dashicons-feedback"></span>
									<?php _e( $current_theme->template . ' Settings', 'ds-core' ); ?>
								</h2>
							</div>
							<div class="ds-block-body">
								<label class="ds-checkbox ds-input-toggle ds-mb-2<?php echo ( !empty( $dsc_settings['include_frontend'] ) ? ' active' : ''); ?>">
									<input name="dsc-settings[include_frontend]" type="checkbox" value="1"<?php echo ( !empty( $dsc_settings['include_frontend'] ) ? ' checked="checked"' : ''); ?> />
									<?php _e( 'Include the DS Core "' . $current_theme->template . ' column overrides" stylesheet on your website.', 'ds-core' ); ?>
								</label>
								<div class="ds-input-toggle-box">
									<div class="ds-mb-2">
										Some text to appear here.
									</div>
								</div>
								<div class="">
									<?php submit_button( '', 'button-primary', '', false ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</form>
		<div class="ds-row">
			<div class="ds-col ds-col-12 ds-col-md-6 ds-col-xl-4 ds-mb-2">
				<div class="ds-block">
					<div class="ds-block-title">
						<h2 class="ds-mt-0 ds-mb-0">
							<span class="dashicons dashicons-feedback"></span>
							<?php _e( 'Support', 'ds-core' ); ?>
						</h2>
					</div>
					<div class="ds-block-body">
						<?php _e(
							'If you require assistance please submit a support request on the divSpot website by filling in the <a href="' . DIVSPOT_URL . '/support" target="_blank">support form</a>.',
							'ds-core'
						); ?>
					</div>
				</div>
			</div>
			<div class="ds-col ds-col-12 ds-col-md-6 ds-col-xl-4 ds-mb-2">
				<div class="ds-block">
					<div class="ds-block-title">
						<h2 class="ds-mt-0 ds-mb-0">
							<span class="dashicons dashicons-feedback"></span>
							<?php _e( 'Review', 'ds-core' ); ?>
						</h2>
					</div>
					<div class="ds-block-body">
						<?php _e(
							'Thank you for supporting divSpot. If you like our plugins please support us by testing some of our other products on the <a href="' . DIVSPOT_URL . '" target="_blank">divSpot website</a>.',
							'ds-core'
						); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
