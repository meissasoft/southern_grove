<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_standard_meta_map' ) ) {
	function bazaar_qodef_header_standard_meta_map( $parent ) {
		$hide_dep_options = bazaar_qodef_get_hide_dep_for_header_standard_meta_boxes();
		
		bazaar_qodef_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'qodef_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'bazaar' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'bazaar' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'bazaar' ),
					'left'   => esc_html__( 'Left', 'bazaar' ),
					'right'  => esc_html__( 'Right', 'bazaar' ),
					'center' => esc_html__( 'Center', 'bazaar' )
				),
				'hidden_property' => 'qodef_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_header_area_meta_boxes_map', 'bazaar_qodef_header_standard_meta_map' );
}