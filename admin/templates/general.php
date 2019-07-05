<?php if(!defined('ABSPATH')) exit; ?>

<div class="ds-wrapper">
	<h1><?php _e('Thank you for using divSpot'); ?></h1>
	<div class="wrap ds-mt-0">
		<h2 class="ds-pt-0 ds-pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
		<div class="ds-blocks-container">
			<div class="ds-row clearfix ds-row-equal-height">
				<div class="ds-block ds-col ds-col-6 ds-mt-2">
					<label class="ds-block-title ds-pt-2 ds-pr-2 ds-pb-2 ds-pl-2">
						<h2 class="ds-mt-0 ds-mb-0">
							<span class="dashicons dashicons-feedback"></span>
							<?php _e('Support'); ?>
						</h2>
					</label>
					<div class="ds-pt-2 ds-pr-2 ds-pb-2 ds-pl-2">
						<p>If you require assistance please submit a support request ticket on divSpot by filling in the <a href="<?php echo DIVSPOT_URL; ?>/support" target="_blank">support form</a>.</p>
					</div>
				</div>
				<div class="ds-block ds-col ds-col-6 ds-mt-2">
					<label class="ds-block-title ds-pt-2 ds-pr-2 ds-pb-2 ds-pl-2">
						<h2 class="ds-mt-0 ds-mb-0">
							<span class="dashicons dashicons-feedback"></span>
							<?php _e('Review'); ?>
						</h2>
					</label>
					<div class="ds-pt-2 ds-pr-2 ds-pb-2 ds-pl-2">
						Thank you for supporting divSpot. If you like like our plugins please support us by testing some
						of our other products at <br /><a href="<?php echo DIVSPOT_URL; ?>" target="_blank"><?php echo DIVSPOT_URL; ?></a>.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
