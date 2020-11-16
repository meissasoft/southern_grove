<?php

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_sticky_header_options' ) ) {
	function bazaar_qodef_get_hide_dep_for_sticky_header_options() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_sticky_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_additional_hide_dep_for_sticky_header_options' ) ) {
	function bazaar_qodef_get_additional_hide_dep_for_sticky_header_options() {
		$additional_hide_dep_options = apply_filters( 'bazaar_qodef_sticky_header_additional_hide_global_option', $additional_hide_dep_options = array() );
		
		return $additional_hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_header_sticky_options_map' ) ) {
	function bazaar_qodef_header_sticky_options_map() {
		$hide_dep_options            = bazaar_qodef_get_hide_dep_for_sticky_header_options();
		$additional_hide_dep_options = bazaar_qodef_get_additional_hide_dep_for_sticky_header_options();
			
		$panel_sticky_header = bazaar_qodef_add_admin_panel(
			array(
				'title'           => esc_html__( 'Sticky Header', 'bazaar' ),
				'name'            => 'panel_sticky_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options,
				'args'            => array(
					'use_both_dep'               => true,
					'additional_hidden_property' => 'header_behaviour',
					'additional_hidden_values'   => $additional_hide_dep_options
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'scroll_amount_for_sticky',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll Amount for Sticky', 'bazaar' ),
				'description' => esc_html__( 'Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis', 'bazaar' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'sticky_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Sticky Header in Grid', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will put sticky header in grid', 'bazaar' ),
				'parent'        => $panel_sticky_header,
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a background color for header area', 'bazaar' ),
				'parent'      => $panel_sticky_header
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_header_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'bazaar' ),
				'description' => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'bazaar' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 1
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_header_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'bazaar' ),
				'description' => esc_html__( 'Set border bottom color for header area', 'bazaar' ),
				'parent'      => $panel_sticky_header
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_header_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Sticky Header Height', 'bazaar' ),
				'description' => esc_html__( 'Enter height for sticky header (default is 60px)', 'bazaar' ),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
		
		$group_sticky_header_menu = bazaar_qodef_add_admin_group(
			array(
				'title'       => esc_html__( 'Sticky Header Menu', 'bazaar' ),
				'name'        => 'group_sticky_header_menu',
				'parent'      => $panel_sticky_header,
				'description' => esc_html__( 'Define styles for sticky menu items', 'bazaar' )
			)
		);
		
		$row1_sticky_header_menu = bazaar_qodef_add_admin_row(
			array(
				'name'   => 'row1',
				'parent' => $group_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__( 'Text Color', 'bazaar' ),
				'description' => '',
				'parent'      => $row1_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'sticky_hovercolor',
				'type'        => 'colorsimple',
				'label'       => esc_html__( esc_html__( 'Hover/Active Color', 'bazaar' ), 'bazaar' ),
				'description' => '',
				'parent'      => $row1_sticky_header_menu
			)
		);
		
		$row2_sticky_header_menu = bazaar_qodef_add_admin_row(
			array(
				'name'   => 'row2',
				'parent' => $group_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'sticky_google_fonts',
				'type'          => 'fontsimple',
				'label'         => esc_html__( 'Font Family', 'bazaar' ),
				'default_value' => '-1',
				'parent'        => $row2_sticky_header_menu,
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_font_size',
				'label'         => esc_html__( 'Font Size', 'bazaar' ),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_line_height',
				'label'         => esc_html__( 'Line Height', 'bazaar' ),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_text_transform',
				'label'         => esc_html__( 'Text Transform', 'bazaar' ),
				'default_value' => '',
				'options'       => bazaar_qodef_get_text_transform_array(),
				'parent'        => $row2_sticky_header_menu
			)
		);
		
		$row3_sticky_header_menu = bazaar_qodef_add_admin_row(
			array(
				'name'   => 'row3',
				'parent' => $group_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'bazaar' ),
				'options'       => bazaar_qodef_get_font_style_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'bazaar' ),
				'options'       => bazaar_qodef_get_font_weight_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'bazaar' ),
				'default_value' => '',
				'parent'        => $row3_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_header_sticky_options_map', 'bazaar_qodef_header_sticky_options_map', 10, 1 );
}