<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_vertical_area_options' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_vertical_options_map' ) ) {
	function bazaar_qodef_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = bazaar_qodef_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = bazaar_qodef_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'bazaar' ),
				'parent'      => $vertical_area_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'bazaar' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'bazaar' ),
				'parent'        => $vertical_area_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'bazaar' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'bazaar' ),
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'bazaar' ),
				'description'   => esc_html__( 'Set border on vertical area', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_vertical_header_shadow_border_container'
				)
			)
		);
		
		$vertical_header_shadow_border_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'hidden_property' => 'vertical_header_border',
				'hidden_value'    => 'no'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'bazaar' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'bazaar' ),
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Center Content', 'bazaar' ),
				'description'   => esc_html__( 'Set content in vertical center', 'bazaar' ),
			)
		);
		
		do_action( 'bazaar_qodef_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'bazaar_qodef_additional_header_menu_area_options_map', 'bazaar_qodef_header_vertical_options_map' );
}