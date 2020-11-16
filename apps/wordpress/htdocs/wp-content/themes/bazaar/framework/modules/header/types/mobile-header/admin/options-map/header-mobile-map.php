<?php

if ( ! function_exists( 'bazaar_qodef_mobile_header_options_map' ) ) {
	function bazaar_qodef_mobile_header_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_mobile_header',
				'title' => esc_html__( 'Mobile Header', 'bazaar' ),
				'icon'  => 'fa fa-mobile'
			)
		);
		
		$panel_mobile_header = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'bazaar' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_mobile_header'
			)
		);
		
		$mobile_header_group = bazaar_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'bazaar' )
			)
		);
		
		$mobile_header_row1 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'bazaar' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'bazaar' ),
				'parent' => $mobile_header_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'bazaar' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = bazaar_qodef_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'bazaar' )
			)
		);
		
		$mobile_menu_row1 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'bazaar' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'bazaar' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'bazaar' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'bazaar' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'bazaar' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'bazaar' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'bazaar' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'bazaar' )
			)
		);
		
		$first_level_group = bazaar_qodef_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'bazaar' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'bazaar' )
			)
		);
		
		$first_level_row1 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'bazaar' ),
				'parent' => $first_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'bazaar' ),
				'parent' => $first_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'bazaar' ),
				'parent' => $first_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'bazaar' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'bazaar' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'bazaar' ),
				'parent'  => $first_level_row2,
				'options' => bazaar_qodef_get_text_transform_array()
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'bazaar' ),
				'parent'  => $first_level_row2,
				'options' => bazaar_qodef_get_font_style_array()
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'bazaar' ),
				'parent'  => $first_level_row2,
				'options' => bazaar_qodef_get_font_weight_array()
			)
		);
		
		$first_level_row3 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'bazaar' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = bazaar_qodef_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'bazaar' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'bazaar' )
			)
		);
		
		$second_level_row1 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'bazaar' ),
				'parent' => $second_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'bazaar' ),
				'parent' => $second_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'bazaar' ),
				'parent' => $second_level_row1
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'bazaar' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'bazaar' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'bazaar' ),
				'parent'  => $second_level_row2,
				'options' => bazaar_qodef_get_text_transform_array()
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'bazaar' ),
				'parent'  => $second_level_row2,
				'options' => bazaar_qodef_get_font_style_array()
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'bazaar' ),
				'parent'  => $second_level_row2,
				'options' => bazaar_qodef_get_font_weight_array()
			)
		);
		
		$second_level_row3 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'bazaar' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'bazaar' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'bazaar' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'bazaar' ),
				'parent' => $panel_mobile_header
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'bazaar' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_mobile_header_options_map', 4 );
}