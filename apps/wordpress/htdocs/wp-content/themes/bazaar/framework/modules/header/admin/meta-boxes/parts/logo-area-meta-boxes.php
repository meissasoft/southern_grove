<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_logo_area_meta_boxes' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_logo_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_logo_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_logo_area_meta_options_map' ) ) {
	function bazaar_qodef_header_logo_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = bazaar_qodef_get_hide_dep_for_header_logo_area_meta_boxes();
		
		$logo_area_container = bazaar_qodef_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'qodef_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_area_style',
				'title'  => esc_html__( 'Logo Area Style', 'bazaar' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_header_widget_logo_area_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Logo Area Widget', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will hide widget area from the logo area', 'bazaar' ),
				'parent'        => $logo_area_container
			)
		);
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $bazaar_custom_sidebars ) > 0 ) {
			bazaar_qodef_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_logo_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area for Logo Area', 'bazaar' ),
					'description' => esc_html__( 'Choose custom widget area to display in header logo area"', 'bazaar' ),
					'parent'      => $logo_area_container,
					'options'     => $bazaar_custom_sidebars
				)
			);
		}
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_logo_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area In Grid', 'bazaar' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'bazaar' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_logo_area_in_grid_container',
						'no'  => '#qodef_logo_area_in_grid_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_logo_area_in_grid_container'
					)
				)
			)
		);
		
		$logo_area_in_grid_container = bazaar_qodef_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_container',
				'parent'          => $logo_area_container,
				'hidden_property' => 'qodef_logo_area_in_grid_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'bazaar' ),
				'description' => esc_html__( 'Set grid background color for logo area', 'bazaar' ),
				'parent'      => $logo_area_in_grid_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'bazaar' ),
				'description' => esc_html__( 'Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'bazaar' ),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_logo_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'bazaar' ),
				'description'   => esc_html__( 'Set border on grid logo area', 'bazaar' ),
				'parent'        => $logo_area_in_grid_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_logo_area_in_grid_border_container',
						'no'  => '#qodef_logo_area_in_grid_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_logo_area_in_grid_border_container'
					)
				)
			)
		);
		
		$logo_area_in_grid_border_container = bazaar_qodef_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_border_container',
				'parent'          => $logo_area_in_grid_container,
				'hidden_property' => 'qodef_logo_area_in_grid_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'bazaar' ),
				'description' => esc_html__( 'Set border color for grid area', 'bazaar' ),
				'parent'      => $logo_area_in_grid_border_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a background color for logo area', 'bazaar' ),
				'parent'      => $logo_area_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'bazaar' ),
				'description' => esc_html__( 'Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'bazaar' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_logo_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area Border', 'bazaar' ),
				'description'   => esc_html__( 'Set border on logo area', 'bazaar' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_logo_area_border_bottom_color_container',
						'no'  => '#qodef_logo_area_border_bottom_color_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_logo_area_border_bottom_color_container'
					)
				)
			)
		);
		
		$logo_area_border_bottom_color_container = bazaar_qodef_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_border_bottom_color_container',
				'parent'          => $logo_area_container,
				'hidden_property' => 'qodef_logo_area_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'bazaar' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'bazaar' ),
				'parent'      => $logo_area_border_bottom_color_container
			)
		);
		
		do_action( 'bazaar_qodef_header_logo_area_additional_meta_boxes_map', $logo_area_container );
	}
	
	add_action( 'bazaar_qodef_header_logo_area_meta_boxes_map', 'bazaar_qodef_header_logo_area_meta_options_map', 10, 1 );
}