<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="qodef-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php bazaar_qodef_inline_style($dropcaps_style);?>>
	<?php echo esc_html($letter);?>
</span>