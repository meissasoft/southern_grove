<?php
/**
 * Highlight shortcode template
 */
?>

<span class="qodef-highlight" <?php bazaar_qodef_inline_style($highlight_style);?>>
	<?php echo esc_html($content);?>
</span>