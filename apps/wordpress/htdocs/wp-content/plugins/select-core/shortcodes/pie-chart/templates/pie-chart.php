<div class="qodef-pie-chart-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pc-percentage" <?php echo bazaar_qodef_get_inline_attrs($pie_chart_data); ?>>
		<span class="qodef-pc-percent" <?php echo bazaar_qodef_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>
	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="qodef-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo esc_attr($title_tag); ?> class="qodef-pc-title" <?php echo bazaar_qodef_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="qodef-pc-text" <?php echo bazaar_qodef_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>