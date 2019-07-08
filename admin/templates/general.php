<?php if(!defined('ABSPATH')) exit; ?>

<div class="ds-wrapper">
	<h1 class="ds-pb-2"><?php _e('Thank you for using divSpot'); ?></h1>
	<div class="wrap ds-mt-0">
		<h2 class="ds-pt-0 ds-pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
		<div class="ds-row ds-row-full ds-row-md-halves ds-row-lg-thirds">
			<div class="ds-block">
				<label class="ds-block-title">
					<h2 class="ds-mt-0 ds-mb-0">
						<span class="dashicons dashicons-feedback"></span>
						<?php _e( 'Support', 'ds-core' ); ?>
					</h2>
				</label>
				<div class="ds-block-body">
					<?php _e(
						'If you require assistance please submit a support request on the divSpot website by filling in the <a href="' . DIVSPOT_URL . '/support" target="_blank">support form</a>.',
						'ds-core'
					); ?>
				</div>
			</div>
			<div class="ds-block">
				<label class="ds-block-title">
					<h2 class="ds-mt-0 ds-mb-0">
						<span class="dashicons dashicons-feedback"></span>
						<?php _e( 'Review', 'ds-core' ); ?>
					</h2>
				</label>
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
