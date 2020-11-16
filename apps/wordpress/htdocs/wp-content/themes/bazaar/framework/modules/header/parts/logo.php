<?php
	$attachment_meta = bazaar_qodef_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

	if(!empty($logo_image_dark)) {
		$attachment_meta_dark = bazaar_qodef_get_attachment_meta_from_url($logo_image_dark);
		$hwstring_dark = !empty($attachment_meta_dark) ? image_hwstring($attachment_meta_dark['width'], $attachment_meta_dark['height']) : '';
	}

	if(!empty($logo_image_light)) {
		$attachment_meta_light = bazaar_qodef_get_attachment_meta_from_url( $logo_image_light );
		$hwstring_light = !empty($attachment_meta_light) ? image_hwstring($attachment_meta_light['width'], $attachment_meta_light['height']) : '';
	}
?>

<?php do_action('bazaar_qodef_before_site_logo'); ?>

<div class="qodef-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php bazaar_qodef_inline_style($logo_styles); ?>>
        <img itemprop="image" class="qodef-normal-logo" src="<?php echo esc_url($logo_image); ?>" <?php echo wp_kses($hwstring, array('width' => true, 'height' => true)); ?> alt="<?php esc_html_e('logo','bazaar'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img itemprop="image" class="qodef-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" <?php echo wp_kses($hwstring_dark, array('width' => true, 'height' => true)); ?> alt="<?php esc_html_e('dark logo','bazaar'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img itemprop="image" class="qodef-light-logo" src="<?php echo esc_url($logo_image_light); ?>" <?php echo wp_kses($hwstring_light, array('width' => true, 'height' => true)); ?> alt="<?php esc_html_e('light logo','bazaar'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('bazaar_qodef_after_site_logo'); ?>