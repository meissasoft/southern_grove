<?php
$main_image = wp_get_attachment_image_src($main_image, 'full');
?>
<div class="qodef-hiding-images">
    <div class="qodef-hi-inner">
        <div class="qodef-hi-other-images">
            <?php echo do_shortcode($content); ?>
        </div>
        <div class="qodef-hi-main-image">
            <?php if(!empty($link)) : ?>
            <a class="qodef-hiding-image-link" href="<?php echo esc_url($link); ?>" <?php bazaar_qodef_inline_attr($target, 'target'); ?>></a>
            <div class="qodef-hi-main-image-holder" style="background-image: url('<?php echo esc_url($main_image[0]); ?>')">
                <?php else: ?>
                <div class="qodef-hi-main-image-holder" style="background-image: url('<?php echo esc_url($main_image[0]); ?>')">
                    <?php endif; ?>
                </div>
                <img class="qodef-hi-laptop" src="<?php echo esc_url(QODE_CORE_URL_PATH); ?>assets/css/img/hidden-images-laptop-frame.png" alt="<?php esc_attr_e('laptop-frame','select-core') ?>">
            </div>
        </div>
    </div>