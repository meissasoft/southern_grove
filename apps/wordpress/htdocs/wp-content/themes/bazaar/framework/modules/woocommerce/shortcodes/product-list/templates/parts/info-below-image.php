<?php
$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size', true);
if(empty($masonry_image_size)) {
    $masonry_image_size = '';
}

$text_wrapper_class = '';
if($display_price == 'no' && $display_rating == 'no'){
    $text_wrapper_class .= 'qodef-no-rating-price';
}
?>
<div class="qodef-pli <?php echo esc_html($masonry_image_size); ?>">
    <div class="qodef-pli-inner">
        <div class="qodef-pli-image">
            <?php bazaar_qodef_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
        </div>
        <div class="qodef-pli-text">
            <div class="qodef-pli-text-outer">
                <div class="qodef-pli-text-inner">
                    <?php do_action('bazaar_qodef_woocommerce_info_below_image_hover'); ?>
                </div>
            </div>
        </div>
        <a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
    </div>
    <div class="qodef-pli-text-wrapper <?php echo esc_html($text_wrapper_class); ?>" <?php echo bazaar_qodef_get_inline_style($text_wrapper_styles); ?>>
        <?php bazaar_qodef_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

        <div class="qodef-pli-price-wrapper">
            <?php bazaar_qodef_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>

            <?php bazaar_qodef_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
        </div>
        
        <?php bazaar_qodef_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>

        <?php bazaar_qodef_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>

        <?php bazaar_qodef_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>

    </div>
</div>