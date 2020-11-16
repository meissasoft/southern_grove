<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_standard_options' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_standard_map' ) ) {
	function bazaar_qodef_header_standard_map( $parent ) {
		$hide_dep_options = bazaar_qodef_get_hide_dep_for_header_standard_options();
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'bazaar' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'bazaar' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'bazaar' ),
					'left'   => esc_html__( 'Left', 'bazaar' ),
					'center' => esc_html__( 'Center', 'bazaar' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_header_menu_area_options_map', 'bazaar_qodef_header_standard_map' );
}