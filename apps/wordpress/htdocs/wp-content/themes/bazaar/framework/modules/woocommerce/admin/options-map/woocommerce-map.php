<?php

if ( ! function_exists('bazaar_qodef_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function bazaar_qodef_woocommerce_options_map() {

		bazaar_qodef_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'bazaar'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = bazaar_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'bazaar')
			)
		);

		bazaar_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'bazaar'),
			'default_value'	=> 'qodef-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'bazaar'),
			'options'		=> array(
				'qodef-woocommerce-columns-3' => esc_html__('3 Columns', 'bazaar'),
				'qodef-woocommerce-columns-4' => esc_html__('4 Columns', 'bazaar')
			),
			'parent'      	=> $panel_product_list,
		));
		
		bazaar_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'bazaar'),
			'default_value'	=> 'qodef-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'bazaar'),
			'options'		=> array(
				'qodef-woo-normal-space' => esc_html__('Normal', 'bazaar'),
				'qodef-woo-small-space'  => esc_html__('Small', 'bazaar'),
				'qodef-woo-no-space'     => esc_html__('No Space', 'bazaar')
			),
			'parent'      	=> $panel_product_list,
		));
		
		bazaar_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'bazaar'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'bazaar'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'bazaar'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'bazaar')
			),
			'parent'      	=> $panel_product_list,
		));

		bazaar_qodef_add_admin_field(array(
			'name'        	=> 'qodef_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'bazaar'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'bazaar'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		bazaar_qodef_add_admin_field(array(
			'name'        	=> 'qodef_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'bazaar'),
			'default_value'	=> 'h4',
			'description' 	=> '',
			'options'       => bazaar_qodef_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = bazaar_qodef_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'bazaar')
			)
		);
		
			bazaar_qodef_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'show_title_area_woo',
					'default_value' => '',
					'label'         => esc_html__( 'Show Title Area', 'bazaar' ),
					'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'bazaar' ),
					'parent'        => $panel_single_product,
					'options'       => bazaar_qodef_get_yes_no_select_array(),
					'args'          => array(
						'col_width' => 3
					)
				)
			);
			
			bazaar_qodef_add_admin_field(
				array(
					'name'          => 'qodef_single_product_title_tag',
					'type'          => 'select',
					'default_value' => 'h2',
					'label'         => esc_html__( 'Single Product Title Tag', 'bazaar' ),
					'options'       => bazaar_qodef_get_title_tag(),
					'parent'        => $panel_single_product,
				)
			);
		
			bazaar_qodef_add_admin_field(
				array(
					'name'          => 'woo_set_thumb_images_position',
					'type'          => 'select',
					'default_value' => 'on-left-side',
					'label'         => esc_html__( 'Set Thumbnail Images Position', 'bazaar' ),
					'options'       => array(
						'below-image'  => esc_html__( 'Below Featured Image', 'bazaar' ),
						'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'bazaar' )
					),
					'parent'        => $panel_single_product
				)
			);
		
			bazaar_qodef_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'woo_enable_single_product_zoom_image',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Zoom Maginfier', 'bazaar' ),
					'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'bazaar' ),
					'parent'        => $panel_single_product,
					'options'       => bazaar_qodef_get_yes_no_select_array( false ),
					'args'          => array(
						'col_width' => 3
					)
				)
			);
		
			bazaar_qodef_add_admin_field(
				array(
					'name'          => 'woo_set_single_images_behavior',
					'type'          => 'select',
					'default_value' => 'pretty-photo',
					'label'         => esc_html__( 'Set Images Behavior', 'bazaar' ),
					'options'       => array(
						'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'bazaar' ),
						'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'bazaar' )
					),
					'parent'        => $panel_single_product
				)
			);
	}

	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_woocommerce_options_map', 21);
}