<div class="qodef-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo bazaar_qodef_get_inline_style($holder_styles); ?>>
	<div class="qodef-st-inner">
		<?php if(!empty($subtitle)) { ?>
			<span class="qodef-st-subtitle" <?php echo bazaar_qodef_get_inline_style($subtitle_styles); ?>>
				<?php echo wp_kses($subtitle, array('br' => true)); ?>
			</span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-st-title" <?php echo bazaar_qodef_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($enable_separator) == 'yes') { ?>
				<span class="qodef-separator" <?php echo bazaar_qodef_get_inline_style($separator_styles); ?>></span>
		<?php } ?>
	</div>
</div>