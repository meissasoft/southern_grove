<div class="qodef-progress-bar <?php echo esc_attr($holder_classes); ?>">
	<<?php echo esc_attr($title_tag); ?> class="qodef-pb-title-holder" <?php echo bazaar_qodef_inline_style($title_styles); ?>>
		<span class="qodef-pb-title"><?php echo esc_html($title); ?></span>
		<span class="qodef-pb-percent">0</span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="qodef-pb-content-holder" <?php echo bazaar_qodef_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="qodef-pb-content" <?php echo bazaar_qodef_inline_style($active_bar_style); ?>></div>
	</div>
</div>