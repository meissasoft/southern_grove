<div class="qodef-pl-holder <?php echo esc_attr($holder_classes) ?>" <?php echo wp_kses($outer_data, array('data')); ?>>
    <?php if($query_result->have_posts()){ ?>
        <?php echo bazaar_qodef_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
        <?php echo bazaar_qodef_get_woo_shortcode_module_template_part('templates/parts/ordering-filter', 'product-list', '', $params); ?>
        <div class="qodef-prl-loading">
            <span class="qodef-prl-loading-msg"><?php esc_html_e('Loading...', 'bazaar') ?></span>
        </div>
        <div class="qodef-pl-outer">
            <div class="qodef-pl-sizer"></div>
            <div class="qodef-pl-gutter"></div>
            <?php while ($query_result->have_posts()) : $query_result->the_post();
                echo bazaar_qodef_get_woo_shortcode_module_template_part('templates/parts/' . $params['info_position'], 'product-list', '', $params);
            endwhile;
            ?>
        </div>
    <?php }else {
        bazaar_qodef_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
    }
    wp_reset_postdata();
    $qodef_unique_id = rand( 1000, 9999 );
    wp_nonce_field( 'qodef_product_load_more_nonce_' . $qodef_unique_id, 'qodef_product_load_more_nonce_' . $qodef_unique_id );
    ?>
</div>