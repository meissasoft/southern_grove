<div class="qodef-pp-holder <?php echo esc_html($holder_classes) ?>">

<?php foreach($products as $prod) : ?>
    <?php
    $product = wc_get_product( $prod['product_id'] );
    $prod['product'] = $product;
    if ($product) {
        $price_html = $product->get_price_html(); 
    } 
    else {
        return;
    }
    ?>

    <div class="qodef-ppi <?php echo esc_html($prod['class_name']); ?>">
        <div class="qodef-ppi-inner">
            <div class="qodef-ppi-image">
                <a class="qodef-ppi-link" itemprop="url" href="<?php echo get_the_permalink($prod['product_id']); ?>" title="<?php the_title_attribute(); ?>">
                    <div class="qodef-ppi-trim" <?php echo bazaar_qodef_get_inline_style($trim_styles); ?>></div>
                    <?php
                        if($prod['enable_custom_image'] == 'no') {
                            echo get_the_post_thumbnail($prod['product_id'], apply_filters('bazaar_qodef_product_list_image_size', $prod['image_size']));
                        }
                        else {
                            echo wp_get_attachment_image($prod['custom_image'], 'full');
                        }
                    ?>
                </a>
                <div class="qodef-ppi-text">
                    <div class="qodef-ppi-text-outer">
                        <div class="qodef-ppi-text-inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="qodef-ppi-text-wrapper clearfix">
                <<?php echo esc_attr($title_tag); ?> itemprop="name" class="entry-title qodef-ppi-title">
                <a itemprop="url" href="<?php echo get_the_permalink($prod['product_id']); ?>"><?php echo get_the_title($prod['product_id']); ?></a>
            </<?php echo esc_attr($title_tag); ?>>
            <div class="qodef-ppi-price-wrapper">
                <div class="qodef-ppi-price"><?php echo wp_kses_post($price_html); ?></div>
                <?php bazaar_qodef_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $prod); ?>
            </div>
            <?php
            $product_categories = wc_get_product_category_list( $product->get_id(), ', ' );
            if (!empty($product_categories)) { ?>
                <p class="qodef-ppi-category"><?php echo wp_kses_post($product_categories); ?></p>
            <?php } ?>
        </div>
        </div>
    </div>
<?php endforeach; ?>

</div>
