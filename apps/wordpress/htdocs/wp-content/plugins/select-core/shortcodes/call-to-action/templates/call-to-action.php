<div class="qodef-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="qodef-cta-text-holder">
			<div class="qodef-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="qodef-cta-button-holder" <?php echo bazaar_qodef_get_inline_style($button_holder_styles); ?>>
			<div class="qodef-cta-button"><?php echo bazaar_qodef_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>