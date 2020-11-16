<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_vertical_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_vertical_area_meta_options_map' ) ) {
	function bazaar_qodef_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = bazaar_qodef_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'hidden_property' => 'qodef_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'bazaar' )
			)
		);
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $bazaar_custom_sidebars ) > 0 ) {
			bazaar_qodef_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_vertical_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area in Vertical area', 'bazaar' ),
					'description' => esc_html__( 'Choose custom widget area to display in vertical menu"', 'bazaar' ),
					'parent'      => $header_vertical_area_meta_container,
					'options'     => $bazaar_custom_sidebars
				)
			);
		}
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'bazaar' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'bazaar' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'bazaar' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'bazaar' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'bazaar' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'bazaar' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array()
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'bazaar' ),
				'description'   => esc_html__( 'Set border on vertical area', 'bazaar' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_vertical_header_border_container',
						'no'  => '#qodef_vertical_header_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_vertical_header_border_container'
					)
				)
			)
		);
		
		$vertical_header_border_container = bazaar_qodef_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'hidden_property' => 'qodef_vertical_header_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'bazaar' ),
				'description' => esc_html__( 'Choose color of border', 'bazaar' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'bazaar' ),
				'description'   => esc_html__( 'Set content in vertical center', 'bazaar' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_header_area_meta_boxes_map', 'bazaar_qodef_header_vertical_area_meta_options_map', 10, 1 );
}