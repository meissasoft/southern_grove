<?php
	$attachment_meta = bazaar_qodef_get_attachment_meta_from_url($logo_image);
	$hwstring = !empty($attachment_meta) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';
?>

<?php do_action('bazaar_qodef_before_mobile_logo'); ?>

<div class="qodef-mobile-logo-wrapper">
    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" <?php bazaar_qodef_inline_style($logo_styles); ?>>
        <img itemprop="image" src="<?php echo esc_url($logo_image); ?>" <?php echo wp_kses($hwstring, array('width' => true, 'height' => true)); ?> alt="<?php esc_html_e('Mobile Logo','bazaar'); ?>"/>
    </a>
</div>

<?php do_action('bazaar_qodef_after_mobile_logo'); ?>