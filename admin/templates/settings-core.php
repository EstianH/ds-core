<?php if( !defined( 'ABSPATH' ) ) exit;

$dsc_settings = get_option( 'dsc_settings' );

$current_theme = wp_get_theme();

?>
<div class="ds-admin-wrapper">
	<h1 class=""><?php echo DSC_TITLE; ?></h1>
	<div class="wrap ds-mt-0">
		<h2 class="ds-pt-0 ds-pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
		<form method="post" action="options.php">
			<?php settings_fields( 'dsc_settings' ); ?>
			<div class="ds-container ds-p-0">
				<div class="ds-row">
					<div class="ds-col ds-mb-2">
						<div class="ds-block">
							<div class="ds-block-title">
								<h2 class="ds-mt-0 ds-mb-0">
									<span class="dashicons dashicons-admin-settings"></span>
									<?php _e( 'Settings', 'ds-core' ); ?>
								</h2>
							</div>
							<div class="ds-block-body">
								<div class="ds-block-toggler<?php echo ( !empty( $dsc_settings['frontend']['include'] ) ? ' active' : ''); ?>">
									<div class="ds-row ds-mb-2">
										<div class="ds-col-12 ds-col-lg-3">
											<strong><?php _e( 'Include the DS Core stylesheet & script on your website.', 'ds-core' ); ?></strong>
										</div>
										<div class="ds-col-12 ds-col-lg-9">
											<label class="ds-toggler ds-mb-2">
												<input
													class="ds-block-toggler-input"
													name="dsc_settings[frontend][include]"
													type="checkbox"
													value="1"
													<?php echo ( !empty( $dsc_settings['frontend']['include'] ) ? 'checked="checked"' : ''); ?> />
													<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="ds-block-toggler-block">
									<div class="ds-row">
										<div class="ds-col-12 ds-col-lg-3">
											<label>
												<strong><?php _e( 'Column Gutter Size:', 'ds-core' ); ?></strong><br />
												<?php _e( '(Use any valid CSS unit, e.g. px, %, em)', 'ds-core' ); ?>
											</label>
										</div>
										<div class="ds-col-12 ds-col-lg-9">
											<input
												class="ds-input-box"
												name="dsc_settings[frontend][gutter-size]"
												type="text"
												value="<?php echo ( !empty( $dsc_settings['frontend']['gutter-size'] ) ? $dsc_settings['frontend']['gutter-size'] : ''); ?>"
												placeholder="15px" />
										</div>
									</div>
								</div>
								<div class="ds-row">
									<div class="ds-col-12">
										<?php submit_button( '', 'button-primary', '', false ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<?php
			/*
			 ██████  ███████ ███    ██ ███████ ██████   █████  ██
			██       ██      ████   ██ ██      ██   ██ ██   ██ ██
			██   ███ █████   ██ ██  ██ █████   ██████  ███████ ██
			██    ██ ██      ██  ██ ██ ██      ██   ██ ██   ██ ██
			 ██████  ███████ ██   ████ ███████ ██   ██ ██   ██ ███████
			*/
			?>
			<div class="ds-row">
				<div class="ds-col-12 ds-col-md-6 ds-col-xl-4 ds-mb-2">
					<div class="ds-block">
						<div class="ds-block-title">
							<h2 class="ds-mt-0 ds-mb-0">
								<span class="dashicons dashicons-format-chat"></span>
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
				<div class="ds-col-12 ds-col-md-6 ds-col-xl-4 ds-mb-2">
					<div class="ds-block">
						<div class="ds-block-title">
							<h2 class="ds-mt-0 ds-mb-0">
								<span class="dashicons dashicons-plugins-checked"></span>
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
</div>
