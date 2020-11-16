<?php

if(!function_exists('bazaar_qodef_map_woocommerce_meta')) {
    function bazaar_qodef_map_woocommerce_meta() {
        $woocommerce_meta_box = bazaar_qodef_create_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'bazaar'),
                'name' => 'woo_product_meta'
            )
        );

        bazaar_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_product_featured_image_size_fixed_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Product List Shortcode - Image Fixed Proportion', 'bazaar' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type product lists where image proportion is fixed', 'bazaar' ),
                'default_value' => 'default',
                'parent'        => $woocommerce_meta_box,
                'options'       => array(
                    'qodef-default'            => esc_html__( 'Default', 'bazaar' ),
                    'qodef-large-width'        => esc_html__( 'Large Width', 'bazaar' ),
                    'qodef-large-height'       => esc_html__( 'Large Height', 'bazaar' ),
                    'qodef-large-width-height' => esc_html__( 'Large Width/Height', 'bazaar' )
                )
            )
        );

        bazaar_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_product_featured_image_size_original_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Dimensions for Product List Shortcode - Image Original Proportion', 'bazaar' ),
                'description'   => esc_html__( 'Choose image layout when it appears in Masonry type product lists where image proportion is original', 'bazaar' ),
                'default_value' => 'default',
                'parent'        => $woocommerce_meta_box,
                'options'       => array(
                    'qodef-default'     => esc_html__( 'Default', 'bazaar' ),
                    'qodef-large-width' => esc_html__( 'Large Width', 'bazaar' )
                )
            )
        );

        bazaar_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'bazaar'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'bazaar'),
                'parent'        => $woocommerce_meta_box,
                'options'       => bazaar_qodef_get_yes_no_select_array()
            )
        );

        bazaar_qodef_create_meta_box_field(array(
            'name'        => 'qodef_single_product_new_meta',
            'type'        => 'select',
            'label'       => esc_html__('Enable New Product Mark', 'bazaar'),
            'description' => esc_html__('Enabling this option will show new product mark on your product lists and product single', 'bazaar'),
            'parent'      => $woocommerce_meta_box,
            'options'     => bazaar_qodef_get_yes_no_select_array(false)
        ));
    }
	
    add_action('bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_woocommerce_meta', 99);
}