<?php $icon_html = bazaar_qodef_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="qodef-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo bazaar_qodef_get_inline_style($holder_styles); ?>>
	<div class="qodef-il-icon-holder">
		<?php echo wp_kses_post($icon_html); ?>
	</div>
	<p class="qodef-il-text" <?php echo bazaar_qodef_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>