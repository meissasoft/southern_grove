<div class="qodef-counter-holder <?php echo esc_attr($holder_classes); ?>" <?php echo bazaar_qodef_get_inline_style($counter_boxed_styles); ?>>
	<div class="qodef-counter-inner">
		<?php if(!empty($digit)) { ?>
			<span class="qodef-counter <?php echo esc_attr($type) ?>" <?php echo bazaar_qodef_get_inline_style($counter_styles); ?>><?php echo esc_html($digit); ?></span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-counter-title" <?php echo bazaar_qodef_get_inline_style($counter_title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="qodef-counter-text" <?php echo bazaar_qodef_get_inline_style($counter_text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>