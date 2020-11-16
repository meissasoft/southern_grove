<?php

if ( ! function_exists( 'bazaar_qodef_get_title_types_meta_boxes' ) ) {
	function bazaar_qodef_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'bazaar_qodef_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'bazaar' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( QODE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'bazaar_qodef_map_title_meta' ) ) {
	function bazaar_qodef_map_title_meta() {
		$title_type_meta_boxes = bazaar_qodef_get_title_types_meta_boxes();
		
		$title_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Title', 'bazaar' ),
				'name'  => 'title_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'bazaar' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'bazaar' ),
				'parent'        => $title_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '',
						'no'  => '#qodef_qodef_show_title_area_meta_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '#qodef_qodef_show_title_area_meta_container',
						'no'  => '',
						'yes' => '#qodef_qodef_show_title_area_meta_container'
					)
				)
			)
		);
		
			$show_title_area_meta_container = bazaar_qodef_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'qodef_show_title_area_meta_container',
					'hidden_property' => 'qodef_show_title_area_meta',
					'hidden_value'    => 'no'
				)
			);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'bazaar' ),
						'description'   => esc_html__( 'Choose title type', 'bazaar' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'bazaar' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'bazaar' ),
						'options'       => bazaar_qodef_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'bazaar' ),
						'description' => esc_html__( 'Set a height for Title Area', 'bazaar' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'bazaar' ),
						'description' => esc_html__( 'Choose a background color for title area', 'bazaar' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'bazaar' ),
						'description' => esc_html__( 'Choose an Image for title area', 'bazaar' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'bazaar' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'bazaar' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'bazaar' ),
							'hide'                => esc_html__( 'Hide Image', 'bazaar' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'bazaar' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'bazaar' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'bazaar' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'bazaar' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'bazaar' )
						)
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'bazaar' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'bazaar' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'bazaar' ),
							'header_bottom' => esc_html__( 'From Bottom of Header', 'bazaar' ),
							'window_top'    => esc_html__( 'From Window Top', 'bazaar' )
						)
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'bazaar' ),
						'options'       => bazaar_qodef_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'bazaar' ),
						'description' => esc_html__( 'Choose a color for title text', 'bazaar' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'bazaar' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'bazaar' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'bazaar' ),
						'options'       => bazaar_qodef_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'bazaar' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'bazaar' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'bazaar_qodef_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_title_meta', 60 );
}